-- Ajoute la table facture et la colonne id_facture dans vente

-- Table facture
CREATE TABLE IF NOT EXISTS `facture` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_client` INT NOT NULL,
  `date_facture` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `montant_total` DECIMAL(12,2) DEFAULT NULL,
  `num_facture` VARCHAR(100) DEFAULT NULL,
  `mode_paiement` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`id_client`),
  CONSTRAINT `fk_facture_client` FOREIGN KEY (`id_client`) REFERENCES `client`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Ajouter colonne id_facture dans vente (ignorer si existe déjà)
ALTER TABLE `vente` ADD COLUMN `id_facture` INT NULL DEFAULT NULL;

-- ajouter clef étrangère (ignorer si existe deja)
ALTER TABLE `vente` ADD CONSTRAINT `fk_vente_facture` FOREIGN KEY (`id_facture`) REFERENCES `facture`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;
-- Table admin pour les directeurs
CREATE TABLE IF NOT EXISTS `admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `prenom` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insérer un admin par défaut (email: admin@admin.com, password: admin123)
INSERT IGNORE INTO `admin` (`nom`, `prenom`, `email`, `password`) 
VALUES ('Admin', 'Admin', 'admin@admin.com', 'admin123');

-- Table employer pour les employés
CREATE TABLE IF NOT EXISTS `employer` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `prenom` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `telephone` VARCHAR(20),
  `adresse` VARCHAR(255),
  `date_creation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;