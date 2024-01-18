<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item" v-for="(tab, index) in tabs_title" :key="index">
                <a class="nav-link" :class="{ active: index === active_tab }" @click="changeTab(index)" :id="'tab' + index" data-bs-toggle="tab" :href="'#contentTab'+index">{{ tab }}</a>
            </li>
        </ul>
    
        <div class="tab-content">
            <div class="tab-pane" :class="{ active: index === active_tab }" :id="'contentTab' + index" v-for="(tab, index) in tabs_title" :key="index">
                <slot :name="'tab' + index"></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { defineProps, ref} from 'vue'
    
    const props = defineProps({
                        tabs_title: Array,
                        active_tab: {
                            type: Number,
                            default: 0 
                        }
                    });

    const activeTab = ref(props.active_tab);

    function changeTab(index) {
      activeTab.value = index;
    }
</script>