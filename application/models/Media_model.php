<?php

/**
 * Created by PhpStorm.
 * User: Origin
 * Date: 7/7/16
 * Time: 15:13
 */
class Media_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_article_list($sort, $page)
    {
        $page = $page < 0 ? 0 : $page;
        if (isset($sort) && $sort != 'all') {
            $sort = urldecode($sort);
            $sql = "SELECT
                      articles.id,
                      articles.date,
                      articles.title,
                      articles.description
                    FROM articles
                      INNER JOIN article_sort ON article_sort.article_id = articles.id
                      INNER JOIN sorts ON sorts.id = article_sort.sort_id
                    WHERE sorts.sort = ? AND articles.id <= (SELECT articles.id
                                                             FROM articles
                                                               INNER JOIN article_sort ON article_sort.article_id = articles.id
                                                               INNER JOIN sorts ON sorts.id = article_sort.sort_id
                                                             WHERE sorts.sort = ?
                                                             ORDER BY articles.date DESC
                                                             LIMIT ?, 1)
                    ORDER BY articles.date DESC
                    LIMIT 10;";
            $query = $this->db->query($sql, array($sort, $sort, $page * 10));
            return $query->result_array();
        } else {
            $sql = "SELECT
                      articles.id,
                      articles.date,
                      articles.title,
                      articles.description
                    FROM articles
                    WHERE articles.id <= (SELECT articles.id
                                          FROM articles
                                          ORDER BY articles.date DESC
                                          LIMIT ?, 1)
                    ORDER BY articles.date DESC
                    LIMIT 10;";
            $query = $this->db->query($sql, array($page * 10));
            return $query->result_array();
        }
    }

    public function search_article_list($keyword, $page)
    {
        $keyword = '%' . $keyword . '%';
        $page = $page < 0 ? 0 : $page;
        $sql = "SELECT
                  articles.id,
                  articles.date,
                  articles.title,
                  articles.description
                FROM articles
                WHERE articles.id <= (SELECT articles.id
                                      FROM articles
                                      WHERE
                                        articles.title LIKE ?
                                        OR articles.content LIKE ?
                                      ORDER BY articles.date DESC
                                      LIMIT ?, 1) AND (articles.title LIKE ? OR articles.content LIKE ?)
                ORDER BY articles.date DESC
                LIMIT 10;";
        $query = $this->db->query($sql, array($keyword, $keyword, $page * 10, $keyword, $keyword));
        return $query->result_array();
    }

    public function article_comment_list($article_id, $page)
    {
        $page = $page < 0 ? 0 : $page;
        $sql = "SELECT
                  article_comment.id,
                  article_comment.date,
                  article_comment.comment,
                  article_comment.user_id,
                  users.name
                FROM article_comment
                  INNER JOIN users ON users.id = article_comment.user_id
                WHERE article_comment.id <= (SELECT id
                             FROM article_comment
                             WHERE article_id = ?
                             ORDER BY date DESC
                             LIMIT ?, 1)
                AND article_id = ?
                ORDER BY DATE DESC
                LIMIT 10;";
        $query = $this->db->query($sql, array($article_id, $page * 10, $article_id));
        return $query->result_array();
    }

    public function comment_down_list($comment_id)
    {
        $sql = "SELECT
                  article_comment_down.id,
                  article_comment_down.owner_id,
                  article_comment_down.user_id,
                  article_comment_down.comment,
                  article_comment_down.date,
                  users1.name AS owner,
                  users2.name AS user
                FROM article_comment_down
                  INNER JOIN users AS users1 ON users1.id = article_comment_down.owner_id
                  INNER JOIN users AS users2 ON users2.id = article_comment_down.user_id
                WHERE article_comment_down.comment_id = ?
                ORDER BY DATE";
        $query = $this->db->query($sql, array($comment_id));
        return $query->result_array();
    }

    public function get_article_info($id)
    {
        $sql = "SELECT
          articles.id,
          articles.date,
          articles.title,
          articles.content,
          users.name
        FROM articles
          INNER JOIN users ON articles.author_id = users.id
        WHERE articles.id = ?;";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function get_article_visit($id)
    {
        $sql = "SELECT id
                FROM article_visit
                WHERE article_id=?;";
        $query = $this->db->query($sql, array($id));
        return $query->num_rows();
    }

    public function add_article_visit($visit)
    {
        return $this->db->insert('article_visit', $visit);
    }

    public function get_article_count($sort)
    {
        if (isset($sort) && $sort != 'all') {
            $sql = "SELECT articles.id
                    FROM articles
                      INNER JOIN article_sort ON article_sort.article_id = articles.id
                      INNER JOIN sorts ON sorts.id = article_sort.sort_id
                    WHERE sorts.sort=?;";
            $query = $this->db->query($sql, array($sort));
            return $query->num_rows();
        } else {
            $sql = "SELECT id
                    FROM articles";
            $query = $this->db->query($sql);
            return $query->num_rows();
        }
    }

    public function search_article_count($keyword)
    {
        $keyword = '%' . $keyword . '%';
        $sql = "SELECT id
                FROM articles
                WHERE title LIKE @keyword OR content LIKE ?";
        $query = $this->db->query($sql, array($keyword));
        return $query->num_rows();
    }

    public function get_sorts_article()
    {
        $sql = "SELECT
                  sorts.sort AS sort,
                  COUNT(sorts.sort) AS count
                FROM sorts
                  INNER JOIN article_sort ON article_sort.sort_id = sorts.id
                GROUP BY sorts.sort;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_sorts_all()
    {
        $sql = "SELECT sort
                FROM sorts";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_sorts_id($sort = NULL)
    {
        $sql = "SELECT id
                FROM sorts
                WHERE sort=?";
        $query = $this->db->query($sql, array($sort));
        return $query->row_array();
    }

    public function create_article($article_item)
    {
        $article = array(
            $article_item['author_id'],
            $article_item['title'],
            $article_item['description'],
            $article_item['content']
        );
        $sort_count = count($article_item['sort']);
        $this->db->trans_start();
        //article
        $article_sql = "INSERT INTO articles (author_id, title, description, content) VALUES (?, ?, ?, ?);";
        $this->db->query($article_sql, $article);
        $id_query = $this->db->query("SELECT LAST_INSERT_ID()");
        $last_id = $id_query->row_array()['LAST_INSERT_ID()'];
        //sort
        for ($i = 0; $i < $sort_count; $i++) {
            $sort_id = $this->get_sorts_id($article_item['sort'][$i])['id'];
            $sql = "INSERT INTO article_sort (article_id, sort_id) VALUES (?,?);";
            $this->db->query($sql, array($last_id, $sort_id));
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    public function update_article($article_item)
    {
        $article = array(
            $article_item['title'],
            $article_item['description'],
            $article_item['content'],
            $article_item['id']
        );
        $sort_count = count($article_item['sort']);
        $bool = FALSE;
        $this->db->trans_start();
        $user_sql = "SELECT author_id
                        FROM articles
                        WHERE id = ?;";
        $query = $this->db->query($user_sql, array($article_item['id']));
        $author_id = $query->row_array()['author_id'];
        if ($author_id == $article_item['user_id']) {
            //article
            $article_sql = "UPDATE articles
                        SET title = ?, description = ?, content = ?
                        WHERE id = ?;";
            $this->db->query($article_sql, $article);
            //sort
            $this->db->query("DELETE FROM article_sort WHERE article_id = ?", array($article_item['id']));
            for ($i = 0; $i < $sort_count; $i++) {
                $sort_id = $this->get_sorts_id($article_item['sort'][$i])['id'];
                $sql = "INSERT INTO article_sort (article_id, sort_id) VALUES (?,?);";
                $this->db->query($sql, array($article_item['id'], $sort_id));
            }
            $bool = TRUE;
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }
        return $bool;
    }

    public function delete_article($delete_item)
    {
        $bool = FALSE;
        $article_sql = "SELECT author_id
                        FROM articles
                        WHERE id = ?;";
        $query = $this->db->query($article_sql, array($delete_item['article_id']));
        $author_id = $query->row_array()['author_id'];
        if ($author_id == $delete_item['user_id']) {
            $this->db->query("DELETE FROM articles WHERE id=?", array($delete_item['article_id']));
            $bool = TRUE;
        }
        return $bool;
    }

    public function add_comment($comment_item)
    {
        return $this->db->insert('article_comment', $comment_item);
    }

    public function delete_comment($comment_item)
    {
        if ($comment_item['type'] == 'comments') {
            $sql = "DELETE FROM article_comment
                WHERE id = ?";
            $query = $this->db->query($sql, array($comment_item['id']));
            return $query->num_rows();
        } else if ($comment_item['type'] == 'comment-down') {
            $sql = "DELETE FROM article_comment_down
                WHERE id = ?";
            $query = $this->db->query($sql, array($comment_item['id']));
            return $query->num_rows();
        }
    }
}