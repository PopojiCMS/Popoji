<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function index()
    {
        $info = [
            'namespace' => 'api/v1',
            'routes' => [
                '/api/v1/post' => [
                    'description' => 'Menampilkan list post',
                    'methods' => [
                        'GET'
                    ],
                    'args' => [
                        'page' => [
                            'required' => false,
                            'description' => 'Menampilkan page post',
                            'type' => 'integer'
                        ],
                        'orderBy' => [
                            'required' => false,
                            'description' => 'Mengurutkan post',
                            'type' => 'string',
                            'enum' => [
                                'ASC', 'DESC'
                            ]
                        ],
                        'category' => [
                            'required' => false,
                            'description' => 'Mengurutkan berdasarkan kategori post',
                            'type' => 'integer'
                        ],
                        'per_page' => [
                            'required' => false,
                            'description' => 'Jumlah post perhalaman',
                            'type' => 'integer'
                        ],
                        'search' => [
                            'required' => false,
                            'description' => 'Mencari post berdasarkan title',
                            'type' => 'string'
                        ],
                        'headline' => [
                            'required' => false,
                            'description' => 'Memilih post headline atau tidak',
                            'type' => 'string',
                            'enum' => [
                                'Y', 'N'
                            ]
                        ],
                    ]
                ],
                '/api/v1/post/{id}' => [
                    'description' => 'Menampilkan detail post',
                    'methods' => [
                        'GET'
                    ],
                ],
                '/api/v1/post/related/{id}' => [
                    'description' => 'Menampilkan list post terkait dengan id',
                    'methods' => [
                        'GET'
                    ],
                    'args' => [
                        'orderBy' => [
                            'required' => false,
                            'description' => 'Mengurutkan post',
                            'type' => 'string',
                            'enum' => [
                                'ASC', 'DESC'
                            ]
                        ],
                        'per_page' => [
                            'required' => false,
                            'description' => 'Jumlah post perhalaman',
                            'type' => 'integer'
                        ]
                    ]
                ],
                '/api/v1/category' => [
                    'description' => 'Menampilkan list category',
                    'methods' => [
                        'GET'
                    ],
                    'args' => [
                        'page' => [
                            'required' => false,
                            'description' => 'Menampilkan page category',
                            'type' => 'integer'
                        ],
                        'orderBy' => [
                            'required' => false,
                            'description' => 'Mengurutkan category',
                            'type' => 'string',
                            'enum' => [
                                'ASC', 'DESC'
                            ]
                        ],
                        'per_page' => [
                            'required' => false,
                            'description' => 'Jumlah category perhalaman',
                            'type' => 'integer'
                        ],
                        'search' => [
                            'required' => false,
                            'description' => 'Mencari category berdasarkan title',
                            'type' => 'string'
                        ]
                    ]
                ],
                '/api/v1/category/{id}' => [
                    'description' => 'Menampilkan detail category',
                    'methods' => [
                        'GET'
                    ],
                ],
                '/api/v1/comment/{id}' => [
                    'description' => 'Menampilkan daftar comment post',
                    'methods' => [
                        'GET'
                    ],
                    'args' => [
                        'page' => [
                            'required' => false,
                            'description' => 'Menampilkan page comment',
                            'type' => 'integer'
                        ],
                        'orderBy' => [
                            'required' => false,
                            'description' => 'Mengurutkan comment',
                            'type' => 'string',
                            'enum' => [
                                'ASC', 'DESC'
                            ]
                        ],
                        'per_page' => [
                            'required' => false,
                            'description' => 'Jumlah comment perhalaman',
                            'type' => 'integer'
                        ],
                        'parent' => [
                            'required' => false,
                            'description' => 'Menampilkan children comment, berdasarkan id parent',
                            'type' => 'integer'
                        ],
                    ]
                ],
            ]
        ];
        return response()->json($info);
    }
}
