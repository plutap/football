drop schema if exists football;
create schema football default character set utf8 collate utf8_polish_ci;
grant all on football.* to editor@localhost identified by 'secretPASSWORD';
flush privileges;