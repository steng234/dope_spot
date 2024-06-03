<template>
  <div>
    <DesktopSearch
      v-if="!isMobile"
      :searchTerm="searchTerm"
      :hasResult="hasResult"
      :matrix="matrix"
      @update-search="updateSearchTerm"
    />
    <MobileSearch
      v-if="isMobile"
      :searchTerm="searchTerm"
      :isSearchVisible="isSearchVisible"
      :hasResult="hasResult"
      :matrix="matrix"
      @toggle-search="toggleSearch"
      @update-search="updateSearchTerm"
    />

  </div>
</template>

<script>
import axios from 'axios';
import { ref, computed, onMounted, onUnmounted } from 'vue';
import DesktopSearch from './DesktopSearch.vue';
import MobileSearch from './MobileSearch.vue';

export default {
  components: {
    DesktopSearch,
    MobileSearch
  },
  setup() {
    const searchTerm = ref('');
    const matrix = ref({
      brand: [],
      category: [],
      product: []
    });
    const isSearchVisible = ref(false);
    const isMobile = ref(window.innerWidth < 768);

    const hasResult = computed(() => 
      Object.keys(matrix.value.brand).length > 0 || 
      Object.keys(matrix.value.category).length > 0 || 
      Object.keys(matrix.value.product).length > 0
    );


    const updateSearchTerm = (newTerm) => {
      searchTerm.value = newTerm;
      search(newTerm);
    };

    const toggleSearch = () => {
      isSearchVisible.value = !isSearchVisible.value;
    };

    const toggleMode = () => {
      isMobile.value = !isMobile.value;
    };

    const handleResize = () => {
      isMobile.value = window.innerWidth < 768;
    };

    const search = (term) => {
      if (term.trim() !== '') {
        axios.get('/search-items', {
          params: { searchTerm: term }
        })
        .then(response => {
          
          matrix.value = response.data.result;
          console.log(matrix.value.brand)
        })
        .catch(error => {
          console.error(error);
        });
      } else {
        matrix.value = { brand: [], category: [], product: [] };
      }
    };

    onMounted(() => {
      window.addEventListener('resize', handleResize);
    });

    onUnmounted(() => {
      window.removeEventListener('resize', handleResize);
    });

    return {
      searchTerm,
      matrix,
      isSearchVisible,
      hasResult,
      isMobile,
      updateSearchTerm,
      toggleSearch,
      toggleMode
    };
  }
};
</script>
