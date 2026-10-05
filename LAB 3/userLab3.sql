CREATE TABLE new_user (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  password VARCHAR(64) NOT NULL,
  PRIMARY KEY (id)
);
CREATE TABLE news (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    imgurl VARCHAR(255),
    content TEXT,
    PRIMARY KEY (id)
);
CREATE TABLE hovbox (
    id INT(11) NOT NULL AUTO_INCREMENT,
    hover_text VARCHAR(255),
    blue_box_text VARCHAR(255),
    image_url VARCHAR(255),
    content TEXT,
    PRIMARY KEY (id)
);
CREATE TABLE white_box3 (
    id INT(11) NOT NULL AUTO_INCREMENT,
    header_text VARCHAR(255),
    PRIMARY KEY (id)
);
CREATE TABLE white_box3_list_items (
    id INT(11) NOT NULL AUTO_INCREMENT,
    white_box3_id INT(11),
    list_item VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (white_box3_id) REFERENCES white_box3(id)
);
CREATE TABLE white_box3_links (
    id INT(11) NOT NULL AUTO_INCREMENT,
    white_box3_id INT(11),
    text VARCHAR(255),
    url VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (white_box3_id) REFERENCES white_box3(id)
);
CREATE TABLE box5 (
    id INT(11) NOT NULL AUTO_INCREMENT,
    header_text VARCHAR(255),
    content TEXT,
    PRIMARY KEY (id)
);
CREATE TABLE box5_links (
    id INT(11) NOT NULL AUTO_INCREMENT,
    box5_id INT(11),
    text VARCHAR(255),
    url VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (box5_id) REFERENCES box5(id)
);
CREATE TABLE box7 (
    id INT(11) NOT NULL AUTO_INCREMENT,
    image_url VARCHAR(255),
    PRIMARY KEY (id)
);
