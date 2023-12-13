<?php

class Entries extends Dbh {
    protected function selectEntries($schoolID) {
        $stmt = $this->connect()->prepare('SELECT * FROM zgloszenia WHERE IdSzkoly = ?;');

        if(!$stmt->execute(array($schoolID))) {
            $stmt = null;
            header("location: ../entriesList.php?error=selectStmtFailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../entriesList.php?error=entries2SelectNotFound");
            exit();
        }

        $selectedEntries = $stmt->fetchAll(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION["zgloszenia"] = $selectedEntries;

        $stmt = null;
    }
}