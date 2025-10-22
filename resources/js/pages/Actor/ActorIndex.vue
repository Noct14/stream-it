<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import Navbar from '@/components/navbar/navbar.vue'

defineProps<{
  actors: Array<{
    id: number
    name: string
    image_url: string
    slug: string
  }>
}>()

// const actors = [
//   { id: 1, name: 'Robert Downey Jr.', slug: 'robert-downey-jr', photo_url: '/images/actors/rdj.webp' },
//   { id: 2, name: 'Scarlett Johansson', slug: 'scarlett-johansson', photo_url: '/images/actors/scarlett.webp' },
//   { id: 3, name: 'Chris Evans', slug: 'chris-evans', photo_url: '/images/actors/evans.webp' },
//   { id: 4, name: 'Tom Holland', slug: 'tom-holland', photo_url: '/images/actors/tom.webp' },

//   { id: 5, name: 'Chris Hemsworth', slug: 'chris-hemsworth', photo_url: '/images/actors/hemsworth.webp' },
//   { id: 6, name: 'Mark Ruffalo', slug: 'mark-ruffalo', photo_url: '/images/actors/ruffalo.webp' },
//   { id: 7, name: 'Jeremy Renner', slug: 'jeremy-renner', photo_url: '/images/actors/renner.webp' },
//   { id: 8, name: 'Brie Larson', slug: 'brie-larson', photo_url: '/images/actors/larson.webp' },
//   { id: 9, name: 'Samuel L. Jackson', slug: 'samuel-l-jackson', photo_url: '/images/actors/jackson.webp' },
//   { id: 10, name: 'Tom Hiddleston', slug: 'tom-hiddleston', photo_url: '/images/actors/hiddleston.webp' },
//   { id: 11, name: 'Elizabeth Olsen', slug: 'elizabeth-olsen', photo_url: '/images/actors/olsen.webp' },
//   { id: 12, name: 'Paul Bettany', slug: 'paul-bettany', photo_url: '/images/actors/bettany.webp' },
//   { id: 13, name: 'Benedict Cumberbatch', slug: 'benedict-cumberbatch', photo_url: '/images/actors/cumberbatch.webp' },
//   { id: 14, name: 'Chadwick Boseman', slug: 'chadwick-boseman', photo_url: '/images/actors/boseman.webp' },
//   { id: 15, name: 'Zoe Saldana', slug: 'zoe-saldana', photo_url: '/images/actors/saldana.webp' },
//   { id: 16, name: 'Karen Gillan', slug: 'karen-gillan', photo_url: '/images/actors/gillan.webp' },
//   { id: 17, name: 'Dave Bautista', slug: 'dave-bautista', photo_url: '/images/actors/bautista.webp' },
//   { id: 18, name: 'Bradley Cooper', slug: 'bradley-cooper', photo_url: '/images/actors/cooper.webp' },
//   { id: 19, name: 'Vin Diesel', slug: 'vin-diesel', photo_url: '/images/actors/diesel.webp' },
//   { id: 20, name: 'Josh Brolin', slug: 'josh-brolin', photo_url: '/images/actors/brolin.webp' },
//   { id: 21, name: 'Evangeline Lilly', slug: 'evangeline-lilly', photo_url: '/images/actors/lilly.webp' },
//   { id: 22, name: 'Paul Rudd', slug: 'paul-rudd', photo_url: '/images/actors/rudd.webp' },
//   { id: 23, name: 'Anthony Mackie', slug: 'anthony-mackie', photo_url: '/images/actors/mackie.webp' },
//   { id: 24, name: 'Sebastian Stan', slug: 'sebastian-stan', photo_url: '/images/actors/stan.webp' },
//   { id: 25, name: 'Don Cheadle', slug: 'don-cheadle', photo_url: '/images/actors/cheadle.webp' },
//   { id: 26, name: 'Gwyneth Paltrow', slug: 'gwyneth-paltrow', photo_url: '/images/actors/paltrow.webp' },
//   { id: 27, name: 'Jon Favreau', slug: 'jon-favreau', photo_url: '/images/actors/favreau.webp' },
//   { id: 28, name: 'Benedict Wong', slug: 'benedict-wong', photo_url: '/images/actors/wong.webp' },
//   { id: 29, name: 'Tessa Thompson', slug: 'tessa-thompson', photo_url: '/images/actors/thompson.webp' },
//   { id: 30, name: 'Natalie Portman', slug: 'natalie-portman', photo_url: '/images/actors/portman.webp' },
//   { id: 31, name: 'Jake Gyllenhaal', slug: 'jake-gyllenhaal', photo_url: '/images/actors/gyllenhaal.webp' },
//   { id: 32, name: 'Jake Johnson', slug: 'jake-johnson', photo_url: '/images/actors/johnson.webp' },
//   { id: 33, name: 'Andrew Garfield', slug: 'andrew-garfield', photo_url: '/images/actors/garfield.webp' },
//   { id: 34, name: 'Tobey Maguire', slug: 'tobey-maguire', photo_url: '/images/actors/maguire.webp' },
//   { id: 35, name: 'Hailee Steinfeld', slug: 'hailee-steinfeld', photo_url: '/images/actors/steinfeld.webp' },
//   { id: 36, name: 'Florence Pugh', slug: 'florence-pugh', photo_url: '/images/actors/pugh.webp' },
//   { id: 37, name: 'Rachel Weisz', slug: 'rachel-weisz', photo_url: '/images/actors/weisz.webp' },
//   { id: 38, name: 'David Harbour', slug: 'david-harbour', photo_url: '/images/actors/harbour.webp' },
//   { id: 39, name: 'Simu Liu', slug: 'simu-liu', photo_url: '/images/actors/liu.webp' },
//   { id: 40, name: 'Awkwafina', slug: 'awkwafina', photo_url: '/images/actors/awkwafina.webp' },
//   { id: 41, name: 'Tony Leung', slug: 'tony-leung', photo_url: '/images/actors/leung.webp' },
//   { id: 42, name: 'Michelle Yeoh', slug: 'michelle-yeoh', photo_url: '/images/actors/yeoh.webp' },
//   { id: 43, name: 'Gemma Chan', slug: 'gemma-chan', photo_url: '/images/actors/chan.webp' },
//   { id: 44, name: 'Richard Madden', slug: 'richard-madden', photo_url: '/images/actors/madden.webp' },
//   { id: 45, name: 'Angelina Jolie', slug: 'angelina-jolie', photo_url: '/images/actors/jolie.webp' },
//   { id: 46, name: 'Salma Hayek', slug: 'salma-hayek', photo_url: '/images/actors/hayek.webp' },
//   { id: 47, name: 'Kit Harington', slug: 'kit-harington', photo_url: '/images/actors/harington.webp' },
//   { id: 48, name: 'Harry Styles', slug: 'harry-styles', photo_url: '/images/actors/styles.webp' },
//   { id: 49, name: 'Ryan Reynolds', slug: 'ryan-reynolds', photo_url: '/images/actors/reynolds.webp' },
//   { id: 50, name: 'Hugh Jackman', slug: 'hugh-jackman', photo_url: '/images/actors/jackman.webp' },
//   { id: 51, name: 'Patrick Stewart', slug: 'patrick-stewart', photo_url: '/images/actors/stewart.webp' },
//   { id: 52, name: 'Ian McKellen', slug: 'ian-mckellen', photo_url: '/images/actors/mckellen.webp' },
//   { id: 53, name: 'James McAvoy', slug: 'james-mcavoy', photo_url: '/images/actors/mcavoy.webp' },
//   { id: 54, name: 'Michael Fassbender', slug: 'michael-fassbender', photo_url: '/images/actors/fassbender.webp' },
//   { id: 55, name: 'Jennifer Lawrence', slug: 'jennifer-lawrence', photo_url: '/images/actors/lawrence.webp' },
//   { id: 56, name: 'Nicholas Hoult', slug: 'nicholas-hoult', photo_url: '/images/actors/hoult.webp' },
//   { id: 57, name: 'Ewan McGregor', slug: 'ewan-mcgregor', photo_url: '/images/actors/mcgregor.webp' },
//   { id: 58, name: 'Natalie Dormer', slug: 'natalie-dormer', photo_url: '/images/actors/dormer.webp' },
//   { id: 59, name: 'Henry Cavill', slug: 'henry-cavill', photo_url: '/images/actors/cavill.webp' },
//   { id: 60, name: 'Gal Gadot', slug: 'gal-gadot', photo_url: '/images/actors/gadot.webp' },
//   { id: 61, name: 'Ben Affleck', slug: 'ben-affleck', photo_url: '/images/actors/affleck.webp' },
//   { id: 62, name: 'Jason Momoa', slug: 'jason-momoa', photo_url: '/images/actors/momoa.webp' },
//   { id: 63, name: 'Ezra Miller', slug: 'ezra-miller', photo_url: '/images/actors/miller.webp' },
//   { id: 64, name: 'Ray Fisher', slug: 'ray-fisher', photo_url: '/images/actors/fisher.webp' },
//   { id: 65, name: 'Margot Robbie', slug: 'margot-robbie', photo_url: '/images/actors/robbie.webp' },
//   { id: 66, name: 'Will Smith', slug: 'will-smith', photo_url: '/images/actors/smith.webp' },
//   { id: 67, name: 'Jared Leto', slug: 'jared-leto', photo_url: '/images/actors/leto.webp' },
//   { id: 68, name: 'Dwayne Johnson', slug: 'dwayne-johnson', photo_url: '/images/actors/johnson-d.webp' },
//   { id: 69, name: 'Emily Blunt', slug: 'emily-blunt', photo_url: '/images/actors/blunt.webp' },
//   { id: 70, name: 'John Krasinski', slug: 'john-krasinski', photo_url: '/images/actors/krasinski.webp' },
//   { id: 71, name: 'Matt Damon', slug: 'matt-damon', photo_url: '/images/actors/damon.webp' },
//   { id: 72, name: 'Leonardo DiCaprio', slug: 'leonardo-dicaprio', photo_url: '/images/actors/dicaprio.webp' },
//   { id: 73, name: 'Kate Winslet', slug: 'kate-winslet', photo_url: '/images/actors/winslet.webp' },
//   { id: 74, name: 'Christian Bale', slug: 'christian-bale', photo_url: '/images/actors/bale.webp' },
//   { id: 75, name: 'Anne Hathaway', slug: 'anne-hathaway', photo_url: '/images/actors/hathaway.webp' },
//   { id: 76, name: 'Morgan Freeman', slug: 'morgan-freeman', photo_url: '/images/actors/freeman.webp' },
//   { id: 77, name: 'Gary Oldman', slug: 'gary-oldman', photo_url: '/images/actors/oldman.webp' },
//   { id: 78, name: 'Heath Ledger', slug: 'heath-ledger', photo_url: '/images/actors/ledger.webp' },
//   { id: 79, name: 'Michael Caine', slug: 'michael-caine', photo_url: '/images/actors/caine.webp' },
//   { id: 80, name: 'Tom Hardy', slug: 'tom-hardy', photo_url: '/images/actors/hardy.webp' },
//   { id: 81, name: 'Cillian Murphy', slug: 'cillian-murphy', photo_url: '/images/actors/murphy.webp' },
//   { id: 82, name: 'Florence Kasumba', slug: 'florence-kasumba', photo_url: '/images/actors/kasumba.webp' },
//   { id: 83, name: 'Daniel Kaluuya', slug: 'daniel-kaluuya', photo_url: '/images/actors/kaluuya.webp' },
//   { id: 84, name: 'Letitia Wright', slug: 'letitia-wright', photo_url: '/images/actors/wright.webp' },
//   { id: 85, name: 'Danai Gurira', slug: 'danai-gurira', photo_url: '/images/actors/gurira.webp' },
//   { id: 86, name: 'Winston Duke', slug: 'winston-duke', photo_url: '/images/actors/duke.webp' },
//   { id: 87, name: 'Angela Bassett', slug: 'angela-bassett', photo_url: '/images/actors/bassett.webp' },
//   { id: 88, name: 'Forest Whitaker', slug: 'forest-whitaker', photo_url: '/images/actors/whitaker.webp' },
//   { id: 89, name: 'Lupita Nyong\'o', slug: 'lupita-nyongo', photo_url: '/images/actors/nyongo.webp' },
//   { id: 90, name: 'Dan Stevens', slug: 'dan-stevens', photo_url: '/images/actors/stevens.webp' },
//   { id: 91, name: 'Emma Watson', slug: 'emma-watson', photo_url: '/images/actors/watson.webp' },
//   { id: 92, name: 'Daniel Radcliffe', slug: 'daniel-radcliffe', photo_url: '/images/actors/radcliffe.webp' },
//   { id: 93, name: 'Rupert Grint', slug: 'rupert-grint', photo_url: '/images/actors/grint.webp' },
//   { id: 94, name: 'Helena Bonham Carter', slug: 'helena-bonham-carter', photo_url: '/images/actors/carter.webp' },
//   { id: 95, name: 'Ralph Fiennes', slug: 'ralph-fiennes', photo_url: '/images/actors/fiennes.webp' },
//   { id: 96, name: 'Alan Rickman', slug: 'alan-rickman', photo_url: '/images/actors/rickman.webp' },
//   { id: 97, name: 'Emma Thompson', slug: 'emma-thompson', photo_url: '/images/actors/thompson.webp' },
//   { id: 98, name: 'Maggie Smith', slug: 'maggie-smith', photo_url: '/images/actors/smith-m.webp' },
//   { id: 99, name: 'Gary Sinise', slug: 'gary-sinise', photo_url: '/images/actors/sinise.webp' },
//   { id: 100, name: 'Tom Cruise', slug: 'tom-cruise', photo_url: '/images/actors/cruise.webp' },
//   { id: 101, name: 'Emily Watson', slug: 'emily-watson', photo_url: '/images/actors/watson-e.webp' },
//   { id: 102, name: 'Keanu Reeves', slug: 'keanu-reeves', photo_url: '/images/actors/reeves.webp' },
//   { id: 103, name: 'Sandra Bullock', slug: 'sandra-bullock', photo_url: '/images/actors/bullock.webp' },
//   { id: 104, name: 'Cate Blanchett', slug: 'cate-blanchett', photo_url: '/images/actors/blanchett.webp' },
// ]

</script>

<template>
  <Head title="All Actors" />
  <div class="min-h-screen bg-black text-white">
    <Navbar />

    <!-- HERO HEADER -->
    <section class="pt-24 pb-10 text-center">
      <h1 class="text-4xl font-extrabold tracking-tight mb-2 bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
        Semua Aktor
      </h1>
      <p class="text-gray-400">Temukan aktor dan aktris favoritmu dari berbagai film terbaik 🎬</p>
    </section>

    <!-- GRID ACTORS -->
    <section class="max-w-7xl mx-auto px-6 pb-20">
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
        <div
          v-for="actor in actors"
          :key="actor.id"
          class="actor-card group relative bg-gray-900 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300"
        >
          <Link :href="`/actor/${actor.slug}`" class="block">
            <img
              :src="actor.image_url"
              :alt="actor.name"
              class="w-full h-56 object-cover group-hover:scale-105 transition duration-500"
              loading="lazy"
            />
            <div
              class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"
            ></div>
            <div
              class="absolute bottom-0 left-0 right-0 p-3 text-center opacity-90 group-hover:opacity-100 transition duration-300"
            >
              <h3 class="text-sm font-semibold text-white truncate">{{ actor.name }}</h3>
            </div>
          </Link>
        </div>
      </div>

      <!-- Jika gak ada data -->
      <div v-if="!actors || actors.length === 0" class="text-center text-gray-400 py-20">
        <p>Belum ada data aktor 😢</p>
      </div>
    </section>
  </div>
</template>

<style>
    @keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
    }

    .actor-card {
    animation: fadeInUp 0.6s ease both;
    }
</style>
