-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    credits DECIMAL(10,2) DEFAULT 0.00,
    real_money DECIMAL(10,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Matches table
CREATE TABLE matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_a VARCHAR(50) NOT NULL,
    team_b VARCHAR(50) NOT NULL,
    match_date DATETIME NOT NULL,
    status ENUM('upcoming', 'live', 'completed') DEFAULT 'upcoming',
    winner VARCHAR(50),
    highest_wicket_taker VARCHAR(50)
);

-- Bets table
CREATE TABLE bets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    match_id INT NOT NULL,
    bet_type ENUM('match_winner', 'highest_wicket_taker', 'over_runs') NOT NULL,
    bet_option VARCHAR(100) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    currency ENUM('credits', 'real_money') NOT NULL,
    over_mark INT,
    result ENUM('pending', 'won', 'lost') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (match_id) REFERENCES matches(id)
);

-- Transactions table
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    currency ENUM('credits', 'real_money') NOT NULL,
    type ENUM('deposit', 'withdrawal', 'bet_win', 'bet_loss') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
); 