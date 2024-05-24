CREATE TABLE users_books (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
    users_id INTEGER NOT NULL, 
    books_id INTEGER NOT NULL, 
    checkaout_date DATETIME DEFAULT NULL,
    return_date DATETIME DEFAULT NULL, 
    CONSTRAINT FK_AD6C8EDB67B3B43D 
        FOREIGN KEY (users_id) 
        REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION 
            NOT DEFERRABLE INITIALLY IMMEDIATE, 
    CONSTRAINT FK_AD6C8EDB7DD8AC20 
        FOREIGN KEY (books_id) 
        REFERENCES books (id) ON UPDATE NO ACTION ON DELETE NO ACTION 
            NOT DEFERRABLE INITIALLY IMMEDIATE
);
CREATE INDEX IDX_AD6C8EDB7DD8AC20
    ON users_books (books_id);
CREATE INDEX IDX_AD6C8EDB67B3B43D 
    ON users_books (users_id);