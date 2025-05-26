<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash; // Import Hash facade for bcrypt

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'General News', 'slug' => 'general-news', 'description' => 'Latest news and updates about Batangas.', 'color' => '#1D4ED8'], // Blue
            ['name' => 'Entertainment', 'slug' => 'entertainment', 'description' => 'Entertainment, events, and lifestyle in Batangas.', 'color' => '#9333EA'], // Purple
            ['name' => 'Sports', 'slug' => 'sports', 'description' => 'Sports news and events in Batangas.', 'color' => '#DB2777'], // Pink
            ['name' => 'Health', 'slug' => 'health', 'description' => 'Health and wellness in Batangas.', 'color' => '#16A34A'], // Green
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create additional users
        $users = [
            [
                'name' => 'Maria Santos',
                'about' => 'A passionate journalist covering Batangas news for over a decade. Maria focuses on in-depth investigative pieces and community stories.',
                'email' => 'maria.santos@batangasblog.com',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Juan Dela Cruz',
                'about' => 'A freelance writer and photographer based in Lipa City. Juan loves to explore the hidden gems of Batangas and share them through his articles.',
                'email' => 'juan.delacruz@batangasblog.com',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Liza Reyes',
                'about' => 'An events correspondent and lifestyle blogger. Liza keeps her finger on the pulse of Batangas entertainment and social scenes.',
                'email' => 'liza.reyes@batangasblog.com',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Antonio "Tonyo" Gonzales',
                'about' => 'A dedicated sports enthusiast and writer, Tonyo covers everything from local basketball leagues to major sporting events in the province.',
                'email' => 'tonyo.gonzales@batangasblog.com',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Dr. Elena Rodriguez',
                'about' => 'A medical professional and health advocate. Dr. Rodriguez contributes articles on public health issues, wellness tips, and healthcare developments in Batangas.',
                'email' => 'elena.rodriguez@batangasblog.com',
                'email_verified_at' => now()
            ],
        ];

        $createdUsers = [];
        foreach ($users as $userData) {
            $createdUsers[] = User::create(array_merge($userData, ['password' => Hash::make('password')]));
        }

        // Create sample articles
        $articles = [
            // General News Articles
            [
                'title' => 'Batangas Province Implements New Traffic Scheme for Holiday Season',
                'slug' => 'batangas-province-new-traffic-scheme-holiday-season',
                'excerpt' => 'The provincial government has announced new traffic rerouting plans to manage the expected influx of visitors during the upcoming holidays.',
                'content' => '<div>
                                <h2>Understanding the New Traffic Flow</h2>
                                <p>The Batangas Provincial Government, in coordination with local police and traffic management units, has unveiled a comprehensive traffic plan aimed at alleviating congestion during the peak holiday season. <strong>Key changes include one-way schemes on major thoroughfares leading to popular tourist destinations and designated parking areas.</strong></p>
                                <p><em>"We anticipate a significant increase in vehicular volume, and these measures are essential to ensure smooth travel for both residents and visitors,"</em> said Governor Hermilando Mandanas during a press briefing.</p>
                                <h3>Affected Areas:</h3>
                                <ul>
                                    <li>Taal Heritage Town</li>
                                    <li>Laiya, San Juan</li>
                                    <li>Anilao, Mabini</li>
                                    <li>Nasugbu Beach areas</li>
                                </ul>
                                <p>Motorists are advised to check the official Batangas provincial website for detailed maps and alternative routes. Additional traffic enforcers will be deployed to guide drivers and enforce the new regulations.</p>
                                <p>Local businesses have expressed optimism that the new scheme, while initially causing some adjustments, will ultimately benefit the tourism sector by making destinations more accessible.</p>
                            </div>',
                'status' => 'published',
                'category_id' => 1, // General News
                'user_id' => $createdUsers[0]->id, // Maria Santos
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'New Community Livelihood Program Launched in Mataasnakahoy',
                'slug' => 'mataasnakahoy-community-livelihood-program',
                'excerpt' => 'A new initiative aims to provide sustainable livelihood opportunities for residents in several barangays of Mataasnakahoy.',
                'content' => '<div>
                                <h2>Empowering Local Residents</h2>
                                <p>The local government of Mataasnakahoy, in partnership with several non-governmental organizations, has officially launched the "Pag-asa sa Pangkabuhayan" program. This initiative focuses on providing skills training and financial assistance to families in underserved communities.</p>
                                <p><em>"Our goal is to equip our residents with the necessary skills and resources to build sustainable livelihoods and improve their quality of life,"</em> stated Mayor Janet Magpantay. The program will initially focus on:</p>
                                <ul>
                                    <li>Organic farming techniques</li>
                                    <li>Handicraft production using local materials</li>
                                    <li>Small-scale food processing</li>
                                </ul>
                                <p>Participants will undergo intensive training sessions followed by mentorship and access to micro-financing options. The program also aims to establish a cooperative to help market the products created by the beneficiaries.</p>
                                <h3>Impact on the Community</h3>
                                <p>Local leaders believe this program will not only boost household incomes but also foster a sense of community entrepreneurship and self-reliance. <strong>The first batch of beneficiaries is expected to complete their training by the end of next quarter.</strong></p>
                            </div>',
                'status' => 'published',
                'category_id' => 1, // General News
                'user_id' => $createdUsers[1]->id, // Juan Dela Cruz
                'published_at' => now()->subDays(5),
            ],

            // Entertainment Articles
            [
                'title' => 'Batangas Gears Up for "Ala Eh! Festival" 2025',
                'slug' => 'batangas-ala-eh-festival-2025',
                'excerpt' => 'The much-awaited Ala Eh! Festival is set to return with more vibrant parades, cultural shows, and culinary delights, celebrating the rich heritage of Batangas.',
                'content' => '<div>
                                <h2>A Grand Celebration of Batangueño Culture</h2>
                                <p>The Batangas Provincial Tourism and Cultural Affairs Office has officially announced the dates and initial lineup for the <strong>Ala Eh! Festival 2025</strong>. Known as the "Mother of all Festivals" in Batangas, this annual event promises an even bigger and brighter celebration of the province\'s unique culture, arts, and traditions.</p>
                                <h3>What to Expect:</h3>
                                <ul>
                                    <li><strong>Street Dancing Competition:</strong> contingents from various municipalities showcasing their interpretations of Batangueño folklore.</li>
                                    <li><strong>Mutya ng Batangas:</strong> A prestigious beauty pageant highlighting the grace and intelligence of Batangueñas.</li>
                                    <li><strong>Trade Fair and Food Expo:</strong> Featuring the best of Batangas products, from Barako coffee to Balisong and delicious local delicacies.</li>
                                    <li><strong>Cultural Performances:</strong> Showcasing traditional music, dances, and theatrical presentations.</li>
                                </ul>
                                <p><em>"The Ala Eh! Festival is more than just a celebration; it\'s a testament to the vibrant spirit and rich heritage of the Batangueño people,"</em> said the head of the tourism office. The festival is expected to draw thousands of local and international tourists.</p>
                                <p>Mark your calendars! The main events will be held in Batangas City, with various activities spread across different towns throughout the festival week.</p>
                            </div>',
                'status' => 'published',
                'category_id' => 2, // Entertainment
                'user_id' => $createdUsers[2]->id, // Liza Reyes
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Must-Visit Coffee Shops in Lipa City for the Perfect Brew',
                'slug' => 'must-visit-coffee-shops-lipa-city',
                'excerpt' => 'Explore the thriving coffee scene in Lipa City, Batangas, known as the "Little Rome of the Philippines" and a haven for coffee lovers.',
                'content' => '<div>
                                <h2>Lipa\'s Booming Coffee Culture</h2>
                                <p>Lipa City, historically a major center for coffee production in the Philippines, continues to honor its heritage with a vibrant and growing coffee shop culture. Whether you\'re a fan of traditional Kapeng Barako or modern artisanal brews, Lipa has something to offer.</p>
                                <h3>Top Picks for Your Coffee Crawl:</h3>
                                <ol>
                                    <li><strong>Café de Lipa:</strong> A classic choice, offering authentic Kapeng Barako and other local coffee varieties. Their ambiance is cozy and perfect for a relaxing afternoon.</li>
                                    <li><strong>Purple Beetle Cafe:</strong> Known for its quirky interiors and creative coffee concoctions. A great spot for Instagram-worthy moments and casual hangouts.</li>
                                    <li><strong>Bo\'s Coffee (Lipa branches):</strong> While a national chain, Bo\'s Coffee highlights Philippine coffee origins, and their Lipa branches offer a comfortable space with reliable brews.</li>
                                    <li><strong>Independent Third-Wave Cafes:</strong> Numerous smaller, independent cafes are popping up, each with unique brewing methods and single-origin beans. Keep an eye out for these hidden gems!</li>
                                </ol>
                                <p><em>"The coffee culture in Lipa is not just about the drink; it\'s about the experience, the community, and the rich history tied to every cup,"</em> shares a local barista.</p>
                                <p>So, next time you\'re in Batangas, make sure to dedicate a day to exploring the delightful coffee shops of Lipa City. <strong>You might just find your new favorite brew!</strong></p>
                            </div>',
                'status' => 'published',
                'category_id' => 2, // Entertainment
                'user_id' => $createdUsers[1]->id, // Juan Dela Cruz
                'published_at' => now()->subDays(10),
            ],

            // Sports Articles
            [
                'title' => 'Batangas City Athletics Prepares for Upcoming National Basketball League',
                'slug' => 'batangas-city-athletics-national-basketball-league-preparations',
                'excerpt' => 'The Batangas City Athletics team is in full swing with their training camp as they gear up for the next season of the National Basketball League.',
                'content' => '<div>
                                <h2>Road to the Championship</h2>
                                <p>The Batangas City Athletics, a formidable team in the National Basketball League (NBL), has intensified its preparations for the upcoming season. Head Coach Eric Gonzales expressed confidence in the team\'s current roster and training regimen.</p>
                                <p><em>"We have a good mix of veteran players and promising rookies this year. The team chemistry is building up well, and everyone is committed to bringing home the championship,"</em> Coach Gonzales stated during a recent practice session.</p>
                                <h3>Training Focus:</h3>
                                <ul>
                                    <li><strong>Strength and Conditioning:</strong> To ensure players are in peak physical form.</li>
                                    <li><strong>Defensive Drills:</strong> Honing their renowned defensive strategies.</li>
                                    <li><strong>Offensive Plays:</strong> Developing new and effective offensive sets.</li>
                                    <li><strong>Team Building Activities:</strong> Fostering camaraderie and on-court communication.</li>
                                </ul>
                                <p>The team will be playing several exhibition games in the coming weeks to fine-tune their strategies and give fans a sneak peek of what to expect. <strong>The official season schedule is expected to be released by the NBL committee next month.</strong></p>
                                <p>Supporters are eagerly anticipating the return of live basketball action and are hopeful for a successful season for the Batangas City Athletics.</p>
                            </div>',
                'status' => 'published',
                'category_id' => 3, // Sports
                'user_id' => $createdUsers[3]->id, // Antonio "Tonyo" Gonzales
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Anilao Hosts Successful International Underwater Photo Competition',
                'slug' => 'anilao-international-underwater-photo-competition',
                'excerpt' => 'Divers and photographers from around the globe converged in Anilao, Mabini, for the prestigious annual underwater photography contest.',
                'content' => '<div>
                                <h2>Capturing the Beauty Beneath the Waves</h2>
                                <p>Anilao, renowned as one of the world\'s premier muck diving destinations, recently concluded its annual International Underwater Photo Competition. The event attracted a record number of participants, showcasing the incredible marine biodiversity of the Verde Island Passage.</p>
                                <p><em>"This competition not only highlights the stunning underwater realm of Anilao but also promotes marine conservation and responsible diving practices,"</em> said the event organizer.</p>
                                <h3>Competition Categories Included:</h3>
                                <ul>
                                    <li>Macro Photography</li>
                                    <li>Wide-Angle Photography</li>
                                    <li>Nudibranch Photography</li>
                                    <li>Fish Portrait</li>
                                    <li>Marine Behavior</li>
                                </ul>
                                <p>The winning entries, featuring vibrant coral reefs, rare critters, and breathtaking underwater landscapes, will be exhibited locally and internationally. <strong>Proceeds from the event will be channeled towards local marine conservation projects in Batangas.</strong></p>
                                <p>The success of the competition further solidifies Anilao\'s position as a top-tier diving and underwater photography hub, contributing significantly to Batangas tourism.</p>
                            </div>',
                'status' => 'published',
                'category_id' => 3, // Sports (can also be entertainment/tourism)
                'user_id' => $createdUsers[1]->id, // Juan Dela Cruz (photographer)
                'published_at' => now()->subDays(12),
            ],

            // Health Articles
            [
                'title' => 'Batangas Provincial Health Office Launches Dengue Awareness Campaign',
                'slug' => 'batangas-pho-dengue-awareness-campaign',
                'excerpt' => 'With the onset of the rainy season, the Provincial Health Office (PHO) is intensifying its campaign against dengue fever across Batangas.',
                'content' => '<div>
                                <h2>Combatting Dengue: A Community Effort</h2>
                                <p>The Batangas Provincial Health Office (PHO) has rolled out a province-wide dengue awareness and prevention campaign as the rainy season begins, a period often associated with a rise in mosquito-borne diseases.</p>
                                <p><em>"Prevention is key. We urge all Batangueños to actively participate in eliminating mosquito breeding sites in their homes and communities,"</em> said Dr. Rosvilinda Ozaeta, Provincial Health Officer.</p>
                                <h3>The "4S" Strategy:</h3>
                                <p>The campaign emphasizes the Department of Health\'s "4S" strategy:</p>
                                <ol>
                                    <li><strong>Search and Destroy:</strong> Actively find and eliminate mosquito breeding places.</li>
                                    <li><strong>Self-Protection Measures:</strong> Use mosquito repellent and wear protective clothing.</li>
                                    <li><strong>Seek Early Consultation:</strong> Consult a doctor immediately if dengue symptoms appear.</li>
                                    <li><strong>Support Fogging/Spraying:</strong> Only in hotspot areas during outbreaks when advised by health authorities.</li>
                                </ol>
                                <p>Local government units are tasked to spearhead cleanup drives and information dissemination activities in their respective areas. <strong>The PHO will also be conducting free dengue testing in select rural health units.</strong></p>
                                <p>Residents are encouraged to maintain vigilance and cooperate with health authorities to prevent a dengue outbreak in the province.</p>
                            </div>',
                'status' => 'published',
                'category_id' => 4, // Health
                'user_id' => $createdUsers[4]->id, // Dr. Elena Rodriguez
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Mental Wellness Programs Expanded in Batangas Public Schools',
                'slug' => 'batangas-mental-wellness-programs-public-schools',
                'excerpt' => 'The Department of Education - Batangas Division is expanding its mental health and wellness programs for students and teachers in public schools.',
                'content' => '<div>
                                <h2>Prioritizing Mental Health in Education</h2>
                                <p>Recognizing the growing importance of mental well-being, the Department of Education (DepEd) - Batangas Division has announced an expansion of its mental wellness programs aimed at students, teachers, and non-teaching personnel in public schools across the province.</p>
                                <p><em>"A healthy mind is crucial for effective learning and teaching. We are committed to creating a supportive and nurturing environment in our schools,"</em> said the Schools Division Superintendent.</p>
                                <h3>Program Components:</h3>
                                <ul>
                                    <li><strong>Counseling Services:</strong> Increased availability of guidance counselors and psychologists.</li>
                                    <li><strong>Mental Health Literacy:</strong> Workshops and seminars for students and teachers on identifying and addressing mental health concerns.</li>
                                    <li><strong>Stress Management Workshops:</strong> Techniques and activities to help manage academic and work-related stress.</li>
                                    <li><strong>Peer Support Groups:</strong> Establishing safe spaces for students to share experiences and support one another.</li>
                                </ul>
                                <p>The initiative will be implemented in phases, starting with high schools and gradually including elementary schools. <strong>Training for school personnel on mental health first aid is also a key component of the program.</strong></p>
                                <p>This proactive approach aims to address the mental health challenges faced by the education sector, especially in the post-pandemic era, fostering a more resilient and empathetic school community in Batangas.</p>
                            </div>',
                'status' => 'published',
                'category_id' => 4, // Health
                'user_id' => $createdUsers[0]->id, // Maria Santos (covering education beat)
                'published_at' => now()->subDays(15),
            ],
        ];

        $createdArticles = [];
        foreach ($articles as $articleData) {
            $createdArticles[] = Article::create($articleData);
        }

        // Create sample comments
        $comments = [
            [
                'content' => 'This is a very important update regarding traffic. Thanks for sharing!',
                'status' => 'approved',
                'author_name' => $createdUsers[1]->name, // Juan Dela Cruz
                'author_email' => $createdUsers[1]->email,
                'article_id' => $createdArticles[0]->id,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'content' => 'Great initiative for Mataasnakahoy! Hope to see more programs like this.',
                'status' => 'approved',
                'author_name' => $createdUsers[0]->name, // Maria Santos
                'author_email' => $createdUsers[0]->email,
                'article_id' => $createdArticles[1]->id,
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'content' => 'Can\'t wait for Ala Eh! Festival! It\'s always the highlight of the year in Batangas.',
                'status' => 'approved',
                'author_name' => $createdUsers[3]->name, // Antonio "Tonyo" Gonzales
                'author_email' => $createdUsers[3]->email,
                'article_id' => $createdArticles[2]->id,
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'content' => 'I\'ve tried Café de Lipa, and their Barako is truly authentic. Will check out the others on this list!',
                'status' => 'pending',
                'author_name' => $createdUsers[2]->name, // Liza Reyes
                'author_email' => $createdUsers[2]->email,
                'article_id' => $createdArticles[3]->id,
                'created_at' => now()->subDays(9),
                'updated_at' => now()->subDays(9),
            ],
            [
                'content' => 'Let\'s go Batangas City Athletics! Rooting for you this season!',
                'status' => 'approved',
                'author_name' => 'Mark Fanatico', // Guest commenter
                'author_email' => 'mark.fan@example.com',
                'article_id' => $createdArticles[4]->id,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'content' => 'The underwater photos from Anilao are always breathtaking. Important to protect our marine life.',
                'status' => 'approved',
                'author_name' => $createdUsers[4]->name, // Dr. Elena Rodriguez
                'author_email' => $createdUsers[4]->email,
                'article_id' => $createdArticles[5]->id,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
            [
                'content' => 'Timely reminder about Dengue prevention. Everyone should follow the 4S strategy.',
                'status' => 'approved',
                'author_name' => $createdUsers[0]->name, // Maria Santos
                'author_email' => $createdUsers[0]->email,
                'article_id' => $createdArticles[6]->id,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'content' => 'This is a great step forward for student well-being in Batangas. Mental health matters!',
                'status' => 'pending',
                'author_name' => 'Concerned Parent', // Guest commenter
                'author_email' => 'parent@example.com',
                'article_id' => $createdArticles[7]->id,
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
        ];

        foreach ($comments as $commentData) {
            Comment::create($commentData);
        }

        // Create default settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Batangas Balita Ngayon', 'type' => 'text'],
            ['key' => 'site_description', 'value' => 'Your source for the latest news, entertainment, sports, and health updates in Batangas province.', 'type' => 'textarea'],
            ['key' => 'contact_email', 'value' => 'contact@batangasbalita.com', 'type' => 'email'],
            ['key' => 'posts_per_page', 'value' => '8', 'type' => 'number'],
            ['key' => 'allow_comments', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'moderate_comments', 'value' => 'true', 'type' => 'boolean'],
        ];

        foreach ($settings as $setting) {
            // Use updateOrCreate to avoid issues if settings with these keys already exist
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
