-- Default password is "admin".
INSERT INTO user(email, hash, display) VALUES
	('admin', '$2y$12$SymKQGP4hpMRvXCB7jtSze3h.6ea6AfZXpdS.0Dx/RMcPJhvSAIui', 'Admin');
INSERT INTO user_manager(id) SELECT MAX(id) FROM user;
