<template>
  <div class="content-navigation">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">探し方を選ぶ</h2>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <a 
        v-for="nav in navigationItems" 
        :key="nav.title"
        :href="nav.url"
        class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden"
        :class="nav.hoverClass"
      >
        <!-- アイコン背景 -->
        <div 
          class="absolute top-0 right-0 w-20 h-20 opacity-10 rounded-bl-full transition-all duration-300 group-hover:opacity-20 group-hover:scale-110"
          :class="nav.bgClass"
        ></div>
        
        <!-- アイコン -->
        <div 
          class="relative z-10 w-12 h-12 rounded-xl flex items-center justify-center mb-4 transition-transform duration-300 group-hover:scale-110"
          :class="nav.iconBgClass"
        >
          <component :is="nav.icon" class="w-6 h-6 text-white" />
        </div>
        
        <h3 class="font-bold text-gray-800 dark:text-white mb-1">{{ nav.title }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ nav.description }}</p>
        
        <!-- 矢印 -->
        <div class="absolute bottom-4 right-4 opacity-0 transform translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">
          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </div>
      </a>
    </div>
  </div>
</template>

<script>
// SVGアイコンコンポーネント
const UserIcon = {
  template: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>`
}

const TagIcon = {
  template: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>`
}

const BookIcon = {
  template: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>`
}

const SparklesIcon = {
  template: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>`
}

export default {
  name: 'ContentNavigation',
  components: {
    UserIcon,
    TagIcon,
    BookIcon,
    SparklesIcon
  },
  data() {
    return {
      navigationItems: [
        {
          title: '人名で探す',
          description: '偉人・著者から名言を探す',
          url: '/authors',
          icon: 'UserIcon',
          bgClass: 'bg-blue-500',
          iconBgClass: 'bg-gradient-to-br from-blue-500 to-blue-600',
          hoverClass: 'hover:border-blue-200'
        },
        {
          title: 'テーマで探す',
          description: '努力・人生・恋愛など',
          url: '/largecategories',
          icon: 'TagIcon',
          bgClass: 'bg-purple-500',
          iconBgClass: 'bg-gradient-to-br from-purple-500 to-purple-600',
          hoverClass: 'hover:border-purple-200'
        },
        {
          title: 'ことわざを学ぶ',
          description: 'ことわざ・四字熟語',
          url: '/proverbs',
          icon: 'BookIcon',
          bgClass: 'bg-green-500',
          iconBgClass: 'bg-gradient-to-br from-green-500 to-green-600',
          hoverClass: 'hover:border-green-200'
        },
        {
          title: '百人一首を学ぶ',
          description: '100首の和歌を鑑賞',
          url: '/hyakuninisshu',
          icon: 'SparklesIcon',
          bgClass: 'bg-amber-500',
          iconBgClass: 'bg-gradient-to-br from-amber-500 to-amber-600',
          hoverClass: 'hover:border-amber-200'
        }
      ]
    }
  }
}
</script>
