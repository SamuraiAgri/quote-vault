<template>
  <article 
    class="quote-card group bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700"
    :class="{ 'border-l-4': accentBorder, [borderColorClass]: accentBorder }"
  >
    <div class="p-6">
      <!-- カテゴリバッジ -->
      <div class="flex items-center justify-between mb-4" v-if="category || type">
        <span 
          class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium"
          :class="badgeClass"
        >
          {{ category || type }}
        </span>
        <span v-if="accessCount" class="text-xs text-gray-400 flex items-center gap-1">
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
          </svg>
          {{ formatNumber(accessCount) }}
        </span>
      </div>
      
      <!-- 名言本文 -->
      <blockquote class="text-lg text-gray-800 dark:text-white leading-relaxed mb-4 line-clamp-3">
        <span v-if="showQuotes">"</span>{{ text }}<span v-if="showQuotes">"</span>
      </blockquote>
      
      <!-- 著者情報 -->
      <div class="flex items-center justify-between">
        <a 
          v-if="authorUrl" 
          :href="authorUrl"
          class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors flex items-center gap-2"
        >
          <div class="w-8 h-8 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-600 dark:to-gray-700 rounded-full flex items-center justify-center text-xs font-bold text-gray-600 dark:text-gray-300">
            {{ authorInitial }}
          </div>
          {{ author }}
        </a>
        <span v-else class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
          <div class="w-8 h-8 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-600 dark:to-gray-700 rounded-full flex items-center justify-center text-xs font-bold text-gray-600 dark:text-gray-300">
            {{ authorInitial }}
          </div>
          {{ author }}
        </span>
      </div>
    </div>
    
    <!-- フッター -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700">
      <a 
        :href="url" 
        class="inline-flex items-center justify-center w-full gap-2 text-sm font-medium py-2.5 rounded-xl transition-all duration-300"
        :class="buttonClass"
      >
        詳細を見る
        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
      </a>
    </div>
  </article>
</template>

<script>
export default {
  name: 'QuoteCard',
  props: {
    text: {
      type: String,
      required: true
    },
    author: {
      type: String,
      default: ''
    },
    authorUrl: {
      type: String,
      default: ''
    },
    url: {
      type: String,
      required: true
    },
    category: {
      type: String,
      default: ''
    },
    type: {
      type: String,
      default: '' // 'quote', 'proverb', 'poem'
    },
    variant: {
      type: String,
      default: 'blue' // 'blue', 'green', 'purple', 'amber'
    },
    accessCount: {
      type: Number,
      default: 0
    },
    accentBorder: {
      type: Boolean,
      default: false
    },
    showQuotes: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    authorInitial() {
      return this.author ? this.author.charAt(0) : '?'
    },
    badgeClass() {
      const classes = {
        blue: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
        green: 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
        purple: 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400',
        amber: 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400'
      }
      return classes[this.variant] || classes.blue
    },
    buttonClass() {
      const classes = {
        blue: 'text-blue-600 hover:bg-blue-600 hover:text-white border-2 border-blue-600',
        green: 'text-green-600 hover:bg-green-600 hover:text-white border-2 border-green-600',
        purple: 'text-purple-600 hover:bg-purple-600 hover:text-white border-2 border-purple-600',
        amber: 'text-amber-600 hover:bg-amber-600 hover:text-white border-2 border-amber-600'
      }
      return classes[this.variant] || classes.blue
    },
    borderColorClass() {
      const classes = {
        blue: 'border-l-blue-500',
        green: 'border-l-green-500',
        purple: 'border-l-purple-500',
        amber: 'border-l-amber-500'
      }
      return classes[this.variant] || classes.blue
    }
  },
  methods: {
    formatNumber(num) {
      if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'k'
      }
      return num.toString()
    }
  }
}
</script>

<style scoped>
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
