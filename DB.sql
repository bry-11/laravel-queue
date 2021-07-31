(
    id         BIGINT UNSIGNED(20),
    name       VARCHAR(255) not null,
    status     VARCHAR(255) not null,
    queue      INT UNSIGNED(10) not null,
    created_at TIMESTAMP(19),
    updated_at TIMESTAMP(19),
    deleted_at TIMESTAMP(19),
    constraint PRIMARY
    primary key (id)
);

create unique index clients_id_unique
    on clients (id);

create table jobs
(
    id           BIGINT UNSIGNED(20),
    queue        VARCHAR(255) not null,
    payload      LONGTEXT(max) not null,
    attempts     TINYINT UNSIGNED(3) not null,
    reserved_at  INT UNSIGNED(10),
    available_at INT UNSIGNED(10) not null,
    created_at   INT UNSIGNED(10) not null,
    constraint PRIMARY
        primary key (id)
);

create index jobs_queue_index
    on jobs (queue);

create table migrations
(
    id        INT UNSIGNED(10),
    migration VARCHAR(255) not null,
    batch     INT(10)      not null,
    constraint PRIMARY
        primary key (id)
);
