create database task_manager;

use task_manager;

CREATE TABLE `tasks` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `status` ENUM('pending','completed') DEFAULT 'pending',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);
 
 INSERT INTO `task_manager`.`tasks` (`id`, `title`, `description`, `status`) VALUES ('1', 'PHP', 'Do not give up!', 'pending');
INSERT INTO `task_manager`.`tasks` (`id`, `title`, `description`, `status`) VALUES ('2', 'C#', 'Do not give up!', 'pending');
INSERT INTO `task_manager`.`tasks` (`id`, `title`, `description`, `status`) VALUES ('3', 'C++', 'Do not give up!', 'completed');
INSERT INTO `task_manager`.`tasks` (`id`, `title`, `description`, `status`) VALUES ('4', 'Java', 'Do not give up!', 'completed');
