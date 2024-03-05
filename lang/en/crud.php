<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'kategori' => [
        'name' => 'Kategori',
        'index_title' => 'Kategori',
        'new_title' => 'New Kategori',
        'create_title' => 'Tambahkan Kategori',
        'edit_title' => 'Edit Kategori',
        'inputs' => [
            'nama' => 'Kategori',
        ],
    ],

    'jenis' => [
        'name' => 'Jenis',
        'index_title' => 'Jenis',
        'new_title' => 'New jenis',
        'create_title' => 'Tambah Jenis',
        'edit_title' => 'Edit Jenis',
        'inputs' => [
            'nama_jenis' => 'Nama Jenis',
            'category_id' => 'Kategori',
        ],
    ],

    'karyawan' => [
        'name' => 'Karyawan',
        'index_title' => 'Karyawan',
        'new_title' => 'New Karyawan',
        'create_title' => 'Tambahkan Karyawan',
        'edit_title' => 'Edit Karyawan',
        'show_title' => 'Data Karyawan',
        'inputs' => [
            'nip' => 'NIP',
            'nik' => 'NIK',
            'nama' => 'Nama',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'telepon' => 'Telepon',
            'agama' => 'Agama',
            'status_nikah' => 'Status Nikah',
            'alamat' => 'Alamat',
            'photo' => 'Photo',
        ],
    ],

    'menu' => [
        'name' => 'Menu',
        'index_title' => 'Menu',
        'new_title' => 'New Menu',
        'create_title' => 'Tambah Menu Baru',
        'edit_title' => 'Edit Menu',
        'show_title' => 'Data Menu',
        'inputs' => [
            'nama' => 'Nama Menu',
            'type_id' => 'Jenis',
            'harga' => 'Harga',
            'photo' => 'Photo',
        ],
    ],

    'stok' => [
        'name' => 'Stok',
        'index_title' => 'Stok Menu',
        'new_title' => 'stok',
        'create_title' => 'Tambah Stok',
        'edit_title' => 'Edit Stok',
        'inputs' => [
            'jumlah' => 'Stok',
            'menu_id' => 'Menu',
        ],
    ],

    'pelanggan' => [
        'name' => 'Pelanggan',
        'index_title' => 'List Pelanggan',
        'new_title' => 'New Pelanggan',
        'create_title' => 'Tambah Pelanggan',
        'edit_title' => 'Edit Pelanggan',
        'inputs' => [
            'nama' => 'Nama',
            'email' => 'Email',
            'alamat' => 'Alamat',
        ],
    ],

    'meja' => [
        'name' => 'Meja',
        'index_title' => 'List meja',
        'new_title' => 'New Meja',
        'create_title' => 'Tambah Meja',
        'edit_title' => 'Edit Meja',
        'inputs' => [
            'nomor_meja' => 'Nomor Meja',
            'kapasitas' => 'Kapasitas',
            'status' => 'Status',
        ],
    ],

    'orders' => [
        'name' => 'Orders',
        'index_title' => 'List Order',
        'new_title' => 'New Order',
        'create_title' => 'Tambah Order',
        'edit_title' => 'Edit Order',
        'inputs' => [
            'jumlah_pelanggan' => 'Jumlah Pelanggan',
            'customer_id' => 'Customer',
            'nama_pemesan' => 'Nama Pemesan',
            'table_id' => 'Table',
            'hari_pesan' => 'Hari Pesan',
            'status' => 'Status',
        ],
    ],

    'produk_titipan' => [
        'name' => 'Produk Titipan',
        'index_title' => 'Data Produk Titipan',
        'new_title' => 'New Produk titipan',
        'create_title' => 'Tambah Produk Titipan',
        'edit_title' => 'Edit Produk Titipan',
        'show_title' => 'Show Produk Titipan',
        'inputs' => [
            'nama_produk' => 'Nama Produk',
            'nama_supplier' => 'Nama Supplier',
            'harga_beli' => 'Harga Beli',
            'harga_jual' => 'Harga Jual',
            'stok' => 'Stok',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'List User',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
