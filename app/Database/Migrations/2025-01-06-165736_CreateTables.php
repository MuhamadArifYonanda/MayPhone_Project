<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        // Tabel pengguna
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'kata_sandi' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pengguna');

        // Tabel produk
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'nama_produk' => ['type' => 'VARCHAR', 'constraint' => 100],
            'harga' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'stok' => ['type' => 'INT'],
            'kategori' => ['type' => 'VARCHAR', 'constraint' => 50],
            'foto_produk' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('produk');

        // Tabel pesanan
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'id_pengguna' => ['type' => 'INT'],
            'total_harga' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'tanggal_pesanan' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_pengguna', 'pengguna', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pesanan');

        // Tabel detail_pesanan
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'id_pesanan' => ['type' => 'INT'],
            'id_produk' => ['type' => 'INT'],
            'jumlah' => ['type' => 'INT'],
            'harga' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_pesanan', 'pesanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_produk', 'produk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_pesanan');
    }

    public function down()
    {
        $this->forge->dropTable('detail_pesanan');
        $this->forge->dropTable('pesanan');
        $this->forge->dropTable('produk');
        $this->forge->dropTable('pengguna');
    }
}
