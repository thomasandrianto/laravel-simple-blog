<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PostSeeder extends Seeder
{
	public function run()
	{
		$now = Carbon::now();
		$posts = [
			[
				'user_id' => 1,
				'title' => 'Nature, Simplicity, and Zen: A Journey into Zen House Design',
				'content' => <<<EOT
				The concept of Zen house design finds its roots in the Zen Buddhism philosophy, which originated in China and later spread to Japan. Zen emphasizes simplicity, mindfulness, and the beauty of natural elements, principles that have significantly influenced Japanese architecture and interior design.

				In its early stages, Zen design was closely tied to the minimalist aesthetics of traditional Japanese homes, known for their tatami mats, sliding doors, and serene gardens. These elements were not just functional but also deeply symbolic, reflecting a connection to nature and a focus on inner peace. The design was characterized by open, flexible spaces that encouraged contemplation and a harmonious lifestyle.

				As Zen philosophy gained global recognition, its influence extended beyond Japan, impacting modern architecture and interior design around the world. Contemporary Zen house design often merges traditional Japanese elements with modern materials and technology, creating spaces that are both aesthetically pleasing and spiritually calming. This fusion has led to the creation of homes that are not only visually stunning but also embody the Zen principles of harmony, simplicity, and connection with nature.
				EOT,
				'image_url' => 'uploads/xQinngp76DUkavIuVUGVBJeNPAdLDMv0IFpLr4oY.png',
				'status' => 'published',
				'scheduled_at' => null,
				'published_at' => '2025-02-26 12:33:00',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'user_id' => 1,
				'title' => 'The History of Java: Vernacular Residential Architecture',
				'content' => <<<EOT
				It is widely believed in the history of Java that the Javanese people are descendants of Austronesian-speaking peoples. The Borobudur temple from the 9th century depicts Javanese houses that were archetypes of Austronesian dwellings with resembling pile foundations, pitched roofs, and an expanded roof bridge. The advent of the Europeans in the 16th and 17th century introduced bricks and masonry that were later adopted in house construction for the prosperous ones.

				Javanese traditional house forms had begun to influence the evolution of Dutch colonial architecture in Indonesia. Since the early 19th century, Dutch Indies country houses were constructed to resemble local indigenous Javanese houses as it could survive better in the intense tropical climate with heat and heavy rain.

				In Javanese vernacular architecture, houses are classified according to their roof configuration following the established hierarchy in the Javanese society and tradition. From the lowest to the highest, there are Omah Kampung, Limasan, and Joglo.
				EOT,
				'image_url' => 'uploads/8rO4uNlcpckckfQMQGME87kr45CFo6yUNmKrbWaq.png',
				'status' => 'published',
				'scheduled_at' => '2025-02-26 12:33:00',
				'published_at' => '2025-02-26 12:33:00',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'user_id' => 1,
				'title' => 'Tamansari Water Castle Yogyakarta',
				'content' => <<<EOT
				Located near the Kraton, this place was also known as the garden for the Sultan of Yogyakarta. Tamansari was originally built for multiple purposes yet now only several buildings remain. Some of its original functions were a place to rest, to meditate, to work, to hide and to defend the Sultan’s family.

				In this present day, some of its buildings have now become homes for local residents and only the mosque, resting and bathing space, and underground tunnels are accessible by tourists.

				With its combination of eastern and western style building, this unique escape of the royal family has its own appeal and story. The most famous place in Tamansari is the bathing and resting place of the Sultan and his Princesses named Umbul Pasiraman. Most tourists find this place interesting as there is a unique story behind its origins.

				The Sultan loves to go hunting during his free time and The Umbul Pasiraman was designed to appease the Sultan of that desire. Different from the Panggung Krapyak which was designed to hunt deer, the Umbul Pasiraman (which means a place to take a bath) was designed for the Princesses to take a bath and for the Sultan to relax and ‘hunt’ for a wife.
				EOT,
				'image_url' => 'uploads/4axaBxE7t3YksXa9SQSF0a0KiMI6Yfw9n3r9zQLy.png',
				'status' => 'scheduled',
				'scheduled_at' => '2025-03-06 00:00:00',
				'published_at' => null,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'user_id' => 1,
				'title' => 'Exploring the Timeless Beauty of Japanese Architecture',
				'content' => <<<EOT
					Japan, a land of ancient traditions and modern innovations, boasts a rich architectural heritage that has captivated the world for centuries. Rooted in its unique cultural, religious, and historical influences, Japanese architecture is characterized by its simplicity, harmony with nature, and meticulous attention to detail.

					Japanese architecture finds its origins in the country’s indigenous cultures, notably Shinto and Buddhism. Shinto and Buddhist infused Japans architecture with spiritual significance and a deep connection to nature. Shintoism, the indigenous animistic belief system of Japan, emphasizes the reverence of kami, spirits dwelling in natural elements. Shinto architecture, notably seen in shrines, embodies this spiritual connection, featuring wooden structures with distinctive curved roofs, chigi, and katsuogi, symbolizing the presence of kami and harmonizing with the surrounding environment.

					Buddhist influence, introduced to Japan from China and Korea, brought elements such as temples, pagodas, and meditation halls. These structures showcase intricate wooden carvings and emphasize balance and symmetry, reflecting Buddhist principles of enlightenment and inner harmony. Both Shinto and Buddhist architectural styles intertwine seamlessly, creating a unique blend that characterizes Japanese buildings, harmonizing the spiritual with the tangible, and exemplifying the nation’s cultural and religious heritage.

					Simplicity and minimalism lie at the heart of Japanese architecture, defining its aesthetic essence and creating spaces of unparalleled elegance. This design philosophy emphasizes the elimination of unnecessary elements, focusing on the fundamental and essential aspects of a structure, uncluttered and serene, allowing occupants to experience a profound sense of tranquility and mindfulness.
					EOT,
				'image_url' => 'uploads/021OP2po8wUplyI3PSDeKFiqVWve2jQn3OWubMv1.png',
				'status' => 'published',
				'scheduled_at' => null,
				'published_at' => '2025-03-03 10:37:04',
				'created_at' => now(),
				'updated_at' => now(),
			],
		];

		// Insert data ke dalam database
		DB::table('posts')->insert($posts);
	}
}
