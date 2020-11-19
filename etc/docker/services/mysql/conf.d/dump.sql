CREATE TABLE IF NOT EXISTS comments
(
    id int auto_increment primary key,
    parent_id int null,
    topic_id int not null,
    body text not null,
    created_at datetime default CURRENT_TIMESTAMP not null
);

create unique index comments_id_uindex
    on comments (id);

INSERT INTO comments (id, parent_id, topic_id, body, created_at) VALUES (1, null, 1, 'Первый комментарий', '2020-11-19 12:09:28');
INSERT INTO comments (id, parent_id, topic_id, body, created_at) VALUES (2, null, 1, 'Второй комментарий', '2020-11-19 12:09:35');
INSERT INTO comments (id, parent_id, topic_id, body, created_at) VALUES (3, 1, 1, 'Первый первый комментарий', '2020-11-19 12:09:45');
INSERT INTO comments (id, parent_id, topic_id, body, created_at) VALUES (4, 1, 1, 'Первый второй комментарий', '2020-11-19 12:09:54');
INSERT INTO comments (id, parent_id, topic_id, body, created_at) VALUES (5, 3, 1, 'Первый первый первый комментарий', '2020-11-19 12:10:10');
