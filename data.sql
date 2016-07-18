CREATE TABLE users (
  id       INT(11)     NOT NULL    AUTO_INCREMENT,
  date     TIMESTAMP   NOT NULL    DEFAULT CURRENT_TIMESTAMP,
  name     VARCHAR(40) NOT NULL,
  pwd      VARCHAR(60) NOT NULL,
  isdelete INT(1)      NOT NULL    DEFAULT 0,
  PRIMARY KEY (id)
);

CREATE TABLE sorts (
  id       INT(11)     NOT NULL    AUTO_INCREMENT,
  date     TIMESTAMP   NOT NULL    DEFAULT CURRENT_TIMESTAMP,
  sort     VARCHAR(60) NOT NULL,
  isdelete INT(1)      NOT NULL    DEFAULT 0,
  PRIMARY KEY (id)
);


CREATE TABLE articles (
  id          INT(11)      NOT NULL    AUTO_INCREMENT,
  date        TIMESTAMP    NOT NULL    DEFAULT CURRENT_TIMESTAMP,
  author_id   INT(11)      NOT NULL,
  title       VARCHAR(60)  NOT NULL,
  description VARCHAR(120) NOT NULL,
  content     TEXT         NOT NULL,
  isdelete    INT(1)       NOT NULL    DEFAULT 0,
  PRIMARY KEY (id),
  KEY author_id (author_id),
  CONSTRAINT article_user FOREIGN KEY (author_id) REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);


CREATE TABLE article_sort (
  id         INT(11) NOT NULL    AUTO_INCREMENT,
  article_id INT(11) NOT NULL,
  sort_id    INT(11) NOT NULL,
  PRIMARY KEY (id),
  KEY article_id (article_id),
  KEY sort_id (sort_id),
  CONSTRAINT article_id_articles FOREIGN KEY (article_id) REFERENCES articles (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT sort_id_sorts FOREIGN KEY (sort_id) REFERENCES sorts (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE article_visit (
  id         INT(11)   NOT NULL    AUTO_INCREMENT,
  date       TIMESTAMP NOT NULL    DEFAULT CURRENT_TIMESTAMP,
  author_id  INT(11)   NOT NULL,
  article_id INT(11)   NOT NULL,
  isdelete   INT(1)    NOT NULL    DEFAULT 0,
  PRIMARY KEY (id),
  KEY author_id (author_id),
  KEY article_id (article_id),
  CONSTRAINT visit_user FOREIGN KEY (author_id) REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT visit_article FOREIGN KEY (article_id) REFERENCES articles (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE article_comment (
  id         INT(11)   NOT NULL    AUTO_INCREMENT,
  date       TIMESTAMP NOT NULL    DEFAULT CURRENT_TIMESTAMP,
  article_id INT(11)   NOT NULL,
  user_id    INT(11)   NOT NULL,
  comment    TEXT      NOT NULL,
  isdelete   INT(1)    NOT NULL    DEFAULT 0,
  PRIMARY KEY (id),
  KEY article_id (article_id),
  KEY user_id (user_id),
  CONSTRAINT article_id_articles FOREIGN KEY (article_id) REFERENCES articles (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT user_id_users FOREIGN KEY (user_id) REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);


SELECT
  articles.id,
  articles.date,
  articles.title,
  articles.description,
  articles.content,
  sorts.sort
FROM articles
  INNER JOIN article_sort ON article_sort.article_id = articles.id
  INNER JOIN sorts ON sorts.id = article_sort.sort_id
WHERE sorts.sort = 'css'

SELECT
  sorts.sort        AS sort,
  COUNT(sorts.sort) AS count
FROM sorts
  INNER JOIN article_sort ON article_sort.sort_id = sorts.id
GROUP BY sorts.sort