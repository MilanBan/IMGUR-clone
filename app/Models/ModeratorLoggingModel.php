<?php

namespace App\Models;

class ModeratorLoggingModel extends Model
{
    public function logging()
    {
        $data = [
            'msg' => $this->msg,
            'created_at' => date("Y-m-d H:i:s")
        ];

        return $this->db->insert('moderator_logging', $data);
    }
}