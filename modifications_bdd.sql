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

-- Ajouter colonne id_facture dans vente si elle n'existe pas
ALTER TABLE `vente` 
ADD COLUMN IF NOT EXISTS `id_facture` INT NULL DEFAULT NULL;

-- ajouter clef étrangère (silencieuse si existe deja)
ALTER TABLE `vente` 
ADD CONSTRAINT `fk_vente_facture` FOREIGN KEY (`id_facture`) REFERENCES `facture`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;
