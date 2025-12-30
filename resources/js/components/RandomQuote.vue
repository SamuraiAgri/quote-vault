<template>
  <div class="random-quote-widget">
    <div 
      class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden"
      :class="{ 'animate-pulse': loading }"
    >
      <!-- 装飾的な背景パターン -->
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white rounded-full translate-y-1/2 -translate-x-1/2"></div>
      </div>
      
      <div class="relative z-10">
        <div class="flex items-center justify-between mb-4">
          <span class="inline-flex items-center gap-2 text-sm font-medium bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            {{ title }}
          </span>
          <button 
            @click="fetchRandom" 
            :disabled="loading"
            class="p-2 hover:bg-white/20 rounded-full transition-all duration-300 disabled:opacity-50"
            title="別の名言を表示"
          >
            <svg class="w-5 h-5" :class="{ 'animate-spin': loading }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
          </button>
        </div>
        
        <blockquote class="text-lg md:text-xl font-medium leading-relaxed mb-4">
          "{{ quote.text }}"
        </blockquote>
        
        <div class="flex items-center justify-between">
          <p class="text-white/80 text-sm">
            — {{ quote.author }}
          </p>
          <a 
            :href="quote.url" 
            class="inline-flex items-center gap-1 text-sm bg-white/20 hover:bg-white/30 px-4 py-2 rounded-full transition-all"
          >
            詳細を見る
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'RandomQuote',
  props: {
    type: {
      type: String,
      default: 'quote', // 'quote', 'proverb', 'poem'
    },
    title: {
      type: String,
      default: 'ランダム名言'
    },
    initialQuote: {
      type: Object,
      default: () => ({
        text: '読み込み中...',
        author: '',
        url: '#'
      })
    }
  },
  data() {
    return {
      quote: this.initialQuote,
      loading: false
    }
  },
  computed: {
    endpoint() {
      const endpoints = {
        quote: '/random/quote',
        proverb: '/random/proverb',
        poem: '/random/poem'
      }
      return endpoints[this.type] || '/random/quote'
    }
  },
  mounted() {
    if (this.quote.text === '読み込み中...') {
      this.fetchRandom()
    }
  },
  methods: {
    async fetchRandom() {
      this.loading = true
      try {
        const response = await fetch(this.endpoint, {
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        const data = await response.json()
        
        // 種類によってレスポンスをマッピング
        if (this.type === 'quote') {
          this.quote = {
            text: data.text,
            author: data.author,
            url: data.url
          }
        } else if (this.type === 'proverb') {
          this.quote = {
            text: data.word,
            author: data.reading,
            url: data.url
          }
        } else if (this.type === 'poem') {
          this.quote = {
            text: `${data.number}番`,
            author: data.poet || '',
            url: data.url
          }
        }
      } catch (error) {
        console.error('Failed to fetch random quote:', error)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>
