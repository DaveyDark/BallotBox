INSERT INTO users (username, password, email) 
VALUES 
('Devesh', 'qq', 'devesh97531@gmail.com'),
('user2', 'password2', 'user2@example.com'),
('a', 'a', 'a@mail'),
('b', 'b', 'b@mail'),
('c', 'c', 'c@mail'),
('d', 'd', 'd@mail'),
('e', 'e', 'e@mail');


INSERT INTO boxes (user_id, name) 
VALUES (1, 'Election');

INSERT INTO ballots (box_id, name) 
VALUES 
(1, 'Alice'),
(1, 'Bob'),
(1, 'Charlie');

INSERT INTO votes (ballot_id, user_id, box_id, rank) 
VALUES 
(1, 3, 1, 0),
(3, 3, 1, 1),
(2, 3, 1, 2),
(1, 4, 1, 0),
(3, 4, 1, 1),
(2, 4, 1, 2),
(2, 5, 1, 0),
(3, 5, 1, 1),
(1, 5, 1, 2),
(2, 6, 1, 0),
(3, 6, 1, 1),
(1, 6, 1, 2),
(3, 7, 1, 0),
(1, 7, 1, 1),
(2, 7, 1, 2);
