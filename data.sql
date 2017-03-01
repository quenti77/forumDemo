# Utilisateur de test
INSERT INTO users (name, password, email, email_token, register_at, connection_at, rank) VALUES
    ('admin', '$2y$12$NZpQdPRMISGpUwPyZGT7JeEGlndr1p3TlH7wERDJ9A01AEDNLn5iq',
        'admin@local.forum', NULL, NOW(), NULL, 3),
    ('test', '$2y$12$KO4j7Ezi3HXq/IM3fpjtAegw4w23/U4fFskZS5.du/nWhgIqYtP2W',
        'test@local.forum', NULL, NOW(), NULL, 1);

# Catégories
INSERT INTO categories (name, sorted) VALUES
    ('Langage front-end', 0),
    ('Langage back-end', 0),
    ('Web Design', 0);

# Forums
INSERT INTO forums (category_id, name, description, topic_count, post_count, last_post_id) VALUES
    (1, 'HTML / CSS', 'Un problème de structure ou d\'implémentation. Par ici', 0, 0, NULL),
    (2, 'PHP', 'Un script ne fonctionne pas ? Demandez de l\'aide sur ce forum', 0, 0, NULL),
    (1, 'Javscript', 'Votre bouton ne fonctionne pas ? Demander par ici', 0, 0, NULL),
    (3, 'Affinity Designer', 'Vous n\'arrivez pas à faire votre maquette ?', 0, 0, NULL);

# Topics
INSERT INTO topics (forum_id, user_id, name, description, reply_count, resolved, locked, first_post_id, last_post_id) VALUES
    (2, 2, 'Syntax error dans mon PHP', 'Je ne comprends pas mon script bug !', 1, 1, 0, 1, 3),
    (2, 1, 'Headers already send', 'Je n\'arrive pas à faire ma redirection', 0, 0, 0, 2, 2),
    (3, 2, 'Problème ajax', 'Mon php ne se lance pas !', 1, 0, 0, 4, 5);

# Posts
INSERT INTO posts (topic_id, user_id, content, posted_at, updated_at, resolved) VALUES
    (1, 2, 'Voici mon code `if (true { echo "yolo"; }`', '2017-03-05 09:54:21', NULL, 0),
    (2, 1, 'Après le post du formulaire', '2017-03-05 12:02:36', NULL, 0),
    (1, 1, 'Regarde bien ton code il manque un caractère', '2017-03-05 13:41:11', NULL, 1),
    (3, 2, 'Je n\'ai pas de retour de ma requête', '2017-03-05 15:27:59', NULL, 0),
    (3, 1, 'Montre nous ton code ^^', '2017-03-05 15:29:41', NULL, 0);
