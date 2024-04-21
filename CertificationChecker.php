<?php
require 'db.php';  // Assuming db.php contains the PDO database connection setup

class CertificationChecker {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Check if the user is certified for a specific robot configuration.
     *
     * @param int $userId User's ID.
     * @param string $robotConfig The robot configuration to check certification against.
     * @return bool Returns true if the user is certified, false otherwise.
     */
    public function isUserCertified($userId, $robotConfig) {
        // Prepare a SQL query to check if there is a valid certification for the user that has not expired.
        $sql = "SELECT COUNT(*) FROM certifications WHERE user_id = ? AND robot_configuration = ? AND cert_status = 'Certified' AND expiration_date >= CURDATE()";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $robotConfig]);
        $count = $stmt->fetchColumn();

        // Return true if there is at least one valid certification, false otherwise
        return $count > 0;
    }
}


?>
