-- Ajouter les colonnes pour l'employee/admin à la table facture
ALTER TABLE `facture` ADD COLUMN `id_employer` INT DEFAULT NULL;
ALTER TABLE `facture` ADD COLUMN `role_user` VARCHAR(20) DEFAULT 'employer' COMMENT 'employer ou admin';
ALTER TABLE `facture` ADD COLUMN `email_user` VARCHAR(100) DEFAULT NULL;

-- Si vous voulez une clé étrangère (optionnel)
-- ALTER TABLE `facture` ADD FOREIGN KEY (`id_employer`) REFERENCES `employer` (`id`) ON DELETE SET NULL;
