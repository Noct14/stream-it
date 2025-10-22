<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import Navbar from '@/components/navbar/navbar.vue'

defineProps<{
  genre: {
    id: number
    name: string
    slug: string
  }[]
}>()

// const genre = [
//   { id: 1, name: 'Action', slug: 'action' },
//   { id: 2, name: 'Drama', slug: 'drama' },
//   { id: 3, name: 'Comedy', slug: 'comedy' },
//   { id: 4, name: 'Adventure', slug: 'adventure' },
//   { id: 5, name: 'Horror', slug: 'horror' },
//   { id: 6, name: 'Thriller', slug: 'thriller' },
//   { id: 7, name: 'Mystery', slug: 'mystery' },
//   { id: 8, name: 'Sci-Fi', slug: 'sci-fi' },
//   { id: 9, name: 'Fantasy', slug: 'fantasy' },
//   { id: 10, name: 'Romance', slug: 'romance' },
//   { id: 11, name: 'Crime', slug: 'crime' },
//   { id: 12, name: 'Animation', slug: 'animation' },
//   { id: 13, name: 'Documentary', slug: 'documentary' },
//   { id: 14, name: 'Biography', slug: 'biography' },
//   { id: 15, name: 'Family', slug: 'family' },
//   { id: 16, name: 'Musical', slug: 'musical' },
//   { id: 17, name: 'War', slug: 'war' },
//   { id: 18, name: 'Western', slug: 'western' },
//   { id: 19, name: 'Sport', slug: 'sport' },
//   { id: 20, name: 'History', slug: 'history' },
//   { id: 21, name: 'Political', slug: 'political' },
//   { id: 22, name: 'Superhero', slug: 'superhero' },
//   { id: 23, name: 'Disaster', slug: 'disaster' },
//   { id: 24, name: 'Noir', slug: 'noir' },
//   { id: 25, name: 'Cyberpunk', slug: 'cyberpunk' },
//   { id: 26, name: 'Steampunk', slug: 'steampunk' },
//   { id: 27, name: 'Post-Apocalyptic', slug: 'post-apocalyptic' },
//   { id: 28, name: 'Zombie', slug: 'zombie' },
//   { id: 29, name: 'Vampire', slug: 'vampire' },
//   { id: 30, name: 'Werewolf', slug: 'werewolf' },
//   { id: 31, name: 'Slasher', slug: 'slasher' },
//   { id: 32, name: 'Psychological', slug: 'psychological' },
//   { id: 33, name: 'Crime Thriller', slug: 'crime-thriller' },
//   { id: 34, name: 'Mystery Thriller', slug: 'mystery-thriller' },
//   { id: 35, name: 'Action Comedy', slug: 'action-comedy' },
//   { id: 36, name: 'Romantic Comedy', slug: 'romantic-comedy' },
//   { id: 37, name: 'Dark Comedy', slug: 'dark-comedy' },
//   { id: 38, name: 'Satire', slug: 'satire' },
//   { id: 39, name: 'Parody', slug: 'parody' },
//   { id: 40, name: 'Mockumentary', slug: 'mockumentary' },
//   { id: 41, name: 'Coming of Age', slug: 'coming-of-age' },
//   { id: 42, name: 'Teen', slug: 'teen' },
//   { id: 43, name: 'Kids', slug: 'kids' },
//   { id: 44, name: 'Fantasy Adventure', slug: 'fantasy-adventure' },
//   { id: 45, name: 'Epic', slug: 'epic' },
//   { id: 46, name: 'Mythology', slug: 'mythology' },
//   { id: 47, name: 'Survival', slug: 'survival' },
//   { id: 48, name: 'Martial Arts', slug: 'martial-arts' },
//   { id: 49, name: 'Spy', slug: 'spy' },
//   { id: 50, name: 'Heist', slug: 'heist' },
//   { id: 51, name: 'Detective', slug: 'detective' },
//   { id: 52, name: 'Legal', slug: 'legal' },
//   { id: 53, name: 'Medical', slug: 'medical' },
//   { id: 54, name: 'School Life', slug: 'school-life' },
//   { id: 55, name: 'Music', slug: 'music' },
//   { id: 56, name: 'Dance', slug: 'dance' },
//   { id: 57, name: 'Road Movie', slug: 'road-movie' },
//   { id: 58, name: 'Travel', slug: 'travel' },
//   { id: 59, name: 'Nature', slug: 'nature' },
//   { id: 60, name: 'Science', slug: 'science' },
//   { id: 61, name: 'Space', slug: 'space' },
//   { id: 62, name: 'Alien', slug: 'alien' },
//   { id: 63, name: 'Time Travel', slug: 'time-travel' },
//   { id: 64, name: 'Dystopian', slug: 'dystopian' },
//   { id: 65, name: 'Utopian', slug: 'utopian' },
//   { id: 66, name: 'Experimental', slug: 'experimental' },
//   { id: 67, name: 'Arthouse', slug: 'arthouse' },
//   { id: 68, name: 'Independent', slug: 'independent' },
//   { id: 69, name: 'Short Film', slug: 'short-film' },
//   { id: 70, name: 'Silent Film', slug: 'silent-film' },
//   { id: 71, name: 'Classic', slug: 'classic' },
//   { id: 72, name: 'Black and White', slug: 'black-and-white' },
//   { id: 73, name: 'Experimental Horror', slug: 'experimental-horror' },
//   { id: 74, name: 'Psychodrama', slug: 'psychodrama' },
//   { id: 75, name: 'Tragedy', slug: 'tragedy' },
//   { id: 76, name: 'Melodrama', slug: 'melodrama' },
//   { id: 77, name: 'Detective Noir', slug: 'detective-noir' },
//   { id: 78, name: 'Neo-Noir', slug: 'neo-noir' },
//   { id: 79, name: 'Adventure Comedy', slug: 'adventure-comedy' },
//   { id: 80, name: 'Fantasy Romance', slug: 'fantasy-romance' },
//   { id: 81, name: 'Historical Romance', slug: 'historical-romance' },
//   { id: 82, name: 'Supernatural', slug: 'supernatural' },
//   { id: 83, name: 'Ghost', slug: 'ghost' },
//   { id: 84, name: 'Religious', slug: 'religious' },
//   { id: 85, name: 'Inspirational', slug: 'inspirational' },
//   { id: 86, name: 'Psychological Thriller', slug: 'psychological-thriller' },
//   { id: 87, name: 'Legal Thriller', slug: 'legal-thriller' },
//   { id: 88, name: 'Erotic Thriller', slug: 'erotic-thriller' },
//   { id: 89, name: 'Gore', slug: 'gore' },
//   { id: 90, name: 'Splatter', slug: 'splatter' },
//   { id: 91, name: 'Creature Feature', slug: 'creature-feature' },
//   { id: 92, name: 'Monster', slug: 'monster' },
//   { id: 93, name: 'Kaiju', slug: 'kaiju' },
//   { id: 94, name: 'Spy Thriller', slug: 'spy-thriller' },
//   { id: 95, name: 'Military', slug: 'military' },
//   { id: 96, name: 'Espionage', slug: 'espionage' },
//   { id: 97, name: 'Detective Comedy', slug: 'detective-comedy' },
//   { id: 98, name: 'Romantic Drama', slug: 'romantic-drama' },
//   { id: 99, name: 'Fantasy Horror', slug: 'fantasy-horror' },
//   { id: 100, name: 'Crime Drama', slug: 'crime-drama' },
// ]

</script>

<template>
  <Head title="All Genres" />
  <Navbar />

  <div class="genre-page">
    <div class="genre-header">
      <h1>🎬 List Genre</h1>
      <p>Pilih genre untuk menemukan film favoritmu</p>
    </div>

    <section class="genre-section">
      <div class="genre-grid">
        <div v-for="genre in genre" :key="genre.id" class="genre-card group">
          <Link :href="`/genre/${genre.slug}`" class="genre-link">
            <h3 class="genre-name">{{ genre.name }}</h3>
          </Link>
        </div>
      </div>

      <div v-if="!genre || genre.length === 0" class="genre-empty">
        <p>Belum ada genre 😢</p>
      </div>
    </section>
  </div>
</template>

<style>
.genre-page {
  padding: 1.5rem;
  padding-top: 6rem;
  min-height: 100vh;
  background: var(--background);
  color: var(--foreground);
}

.genre-header {
  max-width: 64rem;
  margin: 0 auto 2.5rem;
  text-align: center;
}

.genre-header h1 {
  font-size: clamp(1.75rem, 4vw, 2.5rem);
  font-weight: 700;
  letter-spacing: -0.02em;
  margin-bottom: 0.5rem;
}

.genre-header p {
  color: #9ca3af;
  font-size: 0.95rem;
}

.genre-section {
  max-width: 64rem;
  margin: 0 auto;
  padding: 0 1rem 5rem;
}

.genre-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
  gap: 1.5rem;
  justify-items: center;
}

.genre-card {
  position: relative;
  width: 100%;
  height: 7rem;
  background: linear-gradient(to bottom right, rgba(31, 41, 55, 0.8), rgba(55, 65, 81, 0.6));
  border: 1px solid rgba(107, 114, 128, 0.4);
  border-radius: 0.75rem;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 0.75rem;
  transition: 0.3s ease;
  overflow: hidden;
}

.genre-card:hover {
  transform: scale(1.05);
  box-shadow: 0 0 20px var(--primary);
}

.genre-link {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  text-decoration: none;
}

.genre-name {
  color: white;
  font-weight: 600;
  letter-spacing: 0.02em;
  font-size: 1rem;
  line-height: 1.3;
  text-align: center;
  word-break: break-word;
  white-space: normal;
  padding: 0 0.5rem;
  transition: color 0.3s ease;
}

.genre-card:hover .genre-name {
  color: var(--primary);
}

.genre-empty {
  text-align: center;
  color: #9ca3af;
  padding: 5rem 0;
}
</style>

