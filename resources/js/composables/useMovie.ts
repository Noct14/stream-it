import { ref } from 'vue'

export function useMovie() {
  const search = ref('')
  const filtered = (movies: any[]) => {
    if (!search.value) return movies
    return movies.filter((s) =>
      s.title.toLowerCase().includes(search.value.toLowerCase())
    )
  }

  return { search, filtered }
}
