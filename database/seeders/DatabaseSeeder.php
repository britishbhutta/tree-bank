<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Tree Types
        $tree_types = [
            [
                'name' => 'Fruit Trees',
                'description' => 'Tasty and Sweet kind of Fruits Trees.'
            ],
            [
                'name' => 'Shade Trees',
                'description' => 'Very Tall and Wide of Trees with dark shadow.'
            ],
            [
                'name' => 'Flowering Trees',
                'description' => 'Very nice, beautiful  and having fresh smelling kind of Trees.'
            ],
            [
                'name' => 'Native Species',
                'description' => 'Beautiful and Fresh kind of Trees.'
            ],
            [
                'name' => 'Mixed Variety',
                'description' => 'Too many different type of trees.'
            ],
        ];
        $timestamp = now();
        foreach ($tree_types as &$tree_type) {
            $tree_type['created_at'] = $timestamp;
            $tree_type['updated_at'] = $timestamp;
            DB::table('tree_types')->insert($tree_type);
        }
        // Tree Names
        $treeNames = [
            // Fruit Trees (tree_type_id = 1)
            [
                'tree_type_id' => 1,
                'name' => 'Mango Tree',
                'description' => 'A tropical tree known for sweet mango fruits.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 1,
                'name' => 'Apple Tree',
                'description' => 'Produces crunchy and juicy apples.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 1,
                'name' => 'Orange Tree',
                'description' => 'Citrus tree famous for vitamin C rich fruits.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 1,
                'name' => 'Guava Tree',
                'description' => 'Hardy fruit tree with aromatic fruits.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 1,
                'name' => 'Papaya Tree',
                'description' => 'Fast-growing tree with soft, sweet fruits.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],

            // Shade Trees (tree_type_id = 2)
            [
                'tree_type_id' => 2,
                'name' => 'Banyan Tree',
                'description' => 'Large tree providing massive shade.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 2,
                'name' => 'Neem Tree',
                'description' => 'Medicinal tree with dense shade.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 2,
                'name' => 'Peepal Tree',
                'description' => 'Sacred tree known for its wide canopy.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 2,
                'name' => 'Rain Tree',
                'description' => 'Spreading branches with excellent shade.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 2,
                'name' => 'Oak Tree',
                'description' => 'Strong hardwood tree with thick foliage.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],

            // Flowering Trees (tree_type_id = 3)
            [
                'tree_type_id' => 3,
                'name' => 'Gulmohar',
                'description' => 'Bright red flowering ornamental tree.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 3,
                'name' => 'Jacaranda',
                'description' => 'Purple-blue flowers during spring.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 3,
                'name' => 'Cherry Blossom',
                'description' => 'Famous for beautiful pink flowers.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 3,
                'name' => 'Plumeria',
                'description' => 'Fragrant flowers used in garlands.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 3,
                'name' => 'Magnolia',
                'description' => 'Large flowers with a pleasant fragrance.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],

            // Native Species (tree_type_id = 4)
            [
                'tree_type_id' => 4,
                'name' => 'Sal Tree',
                'description' => 'Native hardwood forest tree.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 4,
                'name' => 'Teak Tree',
                'description' => 'Valuable native timber tree.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 4,
                'name' => 'Arjun Tree',
                'description' => 'Medicinal tree found near rivers.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 4,
                'name' => 'Amla Tree',
                'description' => 'Native tree producing gooseberries.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 4,
                'name' => 'Bael Tree',
                'description' => 'Sacred tree with medicinal fruits.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],

            // Mixed Variety (tree_type_id = 5)
            [
                'tree_type_id' => 5,
                'name' => 'Ashoka Tree',
                'description' => 'Evergreen tree with dense leaves.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 5,
                'name' => 'Coconut Tree',
                'description' => 'Multipurpose tropical palm tree.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 5,
                'name' => 'Palm Tree',
                'description' => 'Tall tree commonly found in coastal areas.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 5,
                'name' => 'Eucalyptus',
                'description' => 'Fast-growing tree with aromatic leaves.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'tree_type_id' => 5,
                'name' => 'Pine Tree',
                'description' => 'Evergreen tree found in cold regions.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ];
        DB::table('tree_names')->insert($treeNames);

        // Projects
        $projects = [
    [
        'name' => 'School Plantation Drives',
        'description' => 'Organizing tree plantation activities in schools to educate students about environmental protection and encourage green practices from a young age.',
        'start_date' => $timestamp,
        'end_date' => '',
        'created_at' => $timestamp,
        'updated_at' => $timestamp,
            ],
            [
                'name' => 'Community Tree Distribution',
                'description' => 'We partner with government and private schools to conduct plantation activities, engage students, and teach environmental responsibility.',
                'start_date' => $timestamp,
                'end_date' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'Urban Forest Initiatives',
                'description' => 'We aim to convert unused community spaces into green mini-forests to improve biodiversity and reduce heat.',
                'start_date' => $timestamp,
                'end_date' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'Adopt-a-Tree Program',
                'description' => 'Volunteers can adopt a tree, take care of it, and upload growth photos every month.',
                'start_date' => $timestamp,
                'end_date' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'Awareness Workshops',
                'description' => 'We conduct awareness sessions on climate change, importance of trees, sustainable living, and waste management.',
                'start_date' => $timestamp,
                'end_date' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'Emergency Plantation Support',
                'description' => 'During floods, we plant trees in risk areas to strengthen soil and prevent erosion.',
                'start_date' => $timestamp,
                'end_date' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ];
        DB::table('projects')->insert($projects);
    }
}
