<template>
  <div class="quick-search-section">
    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-6 md:p-8">
      <!-- タブ切り替え -->
      <div class="flex flex-wrap gap-2 mb-6">
        <button 
          v-for="tab in tabs" 
          :key="tab.key"
          @click="activeTab = tab.key"
          :class="[
            'px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300',
            activeTab === tab.key 
              ? 'bg-blue-600 text-white shadow-md' 
              : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
          ]"
        >
          {{ tab.label }}
        </button>
      </div>
      
      <!-- 検索フォーム -->
      <form :action="currentAction" method="GET" class="relative">
        <div class="relative">
          <input 
            type="search" 
            :name="inputName"
            v-model="searchQuery"
            :placeholder="currentPlaceholder"
            class="w-full px-5 py-4 pl-12 text-lg border-2 border-gray-200 dark:border-gray-600 rounded-2xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 bg-gray-50 dark:bg-gray-700 dark:text-white"
          >
          <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
          <button 
            type="submit" 
            class="absolute right-2 top-1/2 -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg"
          >
            検索
          </button>
        </div>
      </form>
      
      <!-- 人気の検索キーワード -->
      <div class="mt-6">
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">人気のキーワード:</p>
        <div class="flex flex-wrap gap-2">
          <a 
            v-for="keyword in currentKeywords" 
            :key="keyword"
            :href="searchUrl(keyword)"
            class="inline-flex items-center gap-1 px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-blue-100 dark:hover:bg-blue-900/30 text-gray-700 dark:text-gray-300 hover:text-blue-700 dark:hover:text-blue-400 rounded-full text-sm transition-all"
          >
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
            </svg>
            {{ keyword }}
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'QuickSearch',
  data() {
    return {
      activeTab: 'all',
      searchQuery: '',
      tabs: [
        { key: 'all', label: 'すべて', action: '/search', placeholder: '名言・ことわざ・百人一首を検索...' },
        { key: 'quote', label: '名言・格言', action: '/search', placeholder: '名言や格言を検索...' },
        { key: 'proverb', label: 'ことわざ', action: '/proverbs/search', placeholder: 'ことわざ・四字熟語を検索...' },
        { key: 'poem', label: '百人一首', action: '/hyakuninisshu/search', placeholder: '百人一首を検索...' }
      ],
      keywords: {
        all: ['努力', '人生', '愛', '成功', '友情', '希望'],
        quote: ['努力', '成功', '失敗', '人生', '愛', '友情'],
        proverb: ['人生', '努力', '失敗', '成功', '友情', '幸運'],
        poem: ['恋', '春', '秋', '月', '花', '風']
      }
    }
  },
  computed: {
    currentTab() {
      return this.tabs.find(t => t.key === this.activeTab)
    },
    currentAction() {
      return this.currentTab?.action || '/search'
    },
    currentPlaceholder() {
      return this.currentTab?.placeholder || '検索...'
    },
    currentKeywords() {
      return this.keywords[this.activeTab] || this.keywords.all
    },
    inputName() {
      return this.activeTab === 'all' || this.activeTab === 'quote' ? 'query' : 'q'
    }
  },
  methods: {
    searchUrl(keyword) {
      const param = this.inputName
      return `${this.currentAction}?${param}=${encodeURIComponent(keyword)}`
    }
  }
}
</script>
