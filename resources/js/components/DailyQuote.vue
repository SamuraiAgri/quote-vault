<template>
  <div class="daily-quote-section">
    <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-900 rounded-3xl p-8 shadow-lg border border-amber-100 dark:border-gray-700">
      <!-- ヘッダー -->
      <div class="flex items-center gap-3 mb-6">
        <div class="flex items-center justify-center w-12 h-12 bg-amber-500 text-white rounded-2xl shadow-lg">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
          </svg>
        </div>
        <div>
          <h2 class="text-xl font-bold text-gray-800 dark:text-white">今日の名言</h2>
          <p class="text-sm text-gray-500 dark:text-gray-400">{{ formattedDate }}</p>
        </div>
      </div>
      
      <!-- 名言本文 -->
      <div class="relative">
        <svg class="absolute -top-2 -left-2 w-8 h-8 text-amber-300 opacity-50" fill="currentColor" viewBox="0 0 24 24">
          <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
        </svg>
        
        <blockquote class="text-xl md:text-2xl text-gray-800 dark:text-white font-medium leading-relaxed pl-6 py-4">
          {{ quote.text }}
        </blockquote>
        
        <div class="flex items-center justify-between mt-6 pt-4 border-t border-amber-200 dark:border-gray-600">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center text-gray-600 font-bold">
              {{ authorInitial }}
            </div>
            <div>
              <p class="font-medium text-gray-800 dark:text-white">{{ quote.author }}</p>
              <p class="text-sm text-gray-500 dark:text-gray-400" v-if="quote.category">{{ quote.category }}</p>
            </div>
          </div>
          
          <a 
            :href="quote.url" 
            class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg"
          >
            もっと読む
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DailyQuote',
  props: {
    quote: {
      type: Object,
      required: true,
      default: () => ({
        text: '',
        author: '',
        category: '',
        url: '#'
      })
    }
  },
  computed: {
    formattedDate() {
      const today = new Date()
      const options = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' }
      return today.toLocaleDateString('ja-JP', options)
    },
    authorInitial() {
      return this.quote.author ? this.quote.author.charAt(0) : '?'
    }
  }
}
</script>
