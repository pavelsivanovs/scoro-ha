<script setup>
import {computed, ref} from 'vue'
import { useTaskStatusesStore } from '../stores/taskStatusesStore.js'
import { useProjectStatusesStore } from '../stores/projectStatusesStore.js'

/**
 * Sends a POST request to the backend to change the status of the entity.
 * @param entityID
 * @param statusID
 * @param isProject
 * @returns void
 */
const statusSelected = async (entityID, statusID, isProject) => {
    const prefix = isProject ? 'project' : 'task'
    await fetch(`http://localhost:8000/api/${ prefix }/${ entityID }/newstatus/${ statusID }`)
        .then(res => res.json())
        .then(res => res.data)
        .catch(err => console.error('Error changing the status', err))

    currentStatus.value = statuses.filter(el => el.status_id === statusID)[0]
    toggleListVisibility()
}

/**
 * @param {DragEvent} event
 * @param {string} status_id
 */
const startDrag = (event, status_id) => {
    event.dataTransfer.dropEffect = 'move'
    event.dataTransfer.effectAllowed = 'move'
    event.dataTransfer.setData('statusID', status_id)
}

/**
 * @param {DragEvent} event
 * @param {string} status_id
 */
const onDrop = (event, status_id) => {
    const draggedStatusID = event.dataTransfer.getData('statusID')
    console.log(`Status ${draggedStatusID} was dragged over the status ${status_id}`)

    if (props.is_project) {
        projectStatuses.swap(status_id, draggedStatusID)
    } else {
        taskStatuses.swap(status_id, draggedStatusID)
    }
}

/**
 * @param statuses
 * @param {string} statusID
 * @returns {*|{status_id: string, status_name: string}}
 */
const getCurrentStatus = (statuses, statusID) => {
    const current = statuses.filter(el => el.status_id === statusID)[0]

    return current || {
        status_id: statusID,
        status_name: 'INVALID STATUS'
    }
}

/**
 * Change the visibility state of the status list
 */
const toggleListVisibility = () => {
    isVisible.value = !isVisible.value
}

const projectStatuses = useProjectStatusesStore()
const taskStatuses = useTaskStatusesStore()

const isVisible = ref(false)

const props = defineProps({
    status_id: String,
    entity_id: Number,
    is_project: Boolean
})

const statuses = props.is_project ? projectStatuses.statuses : taskStatuses.statuses
const currentStatus = ref(getCurrentStatus(statuses, props.status_id))

const buttonTextColor = computed(() => {
    const red = parseInt(currentStatus.value.color.substring(1,3), 16)
    const green = parseInt(currentStatus.value.color.substring(3,5), 16)
    const blue = parseInt(currentStatus.value.color.substring(5, 7), 16)

    return (red * 0.299) + (green * 0.587) + (blue * 0.114) > 186 ? '#000000' : '#ffffff'
})

let firstTime = true
/**
 * Vue3 custom directive for toggling the visibility of the status list when user clicks outside it.
 */
const vClickOutside = {
    mounted: (el) => {
        el.clickOutsideEvent = (event) => {
            if (!(el === event.target || el.contains(event.target))) {
                console.log('OUTSIDE')
                if (firstTime) {
                    console.log('First time')
                    firstTime = false
                } else {
                    toggleListVisibility()
                }
            }
        }

        document.body.addEventListener('click', el.clickOutsideEvent)
    },
    unmounted(el) {
        firstTime = true
        document.body.removeEventListener('click', el.clickOutsideEvent)
    }
}
</script>

<template>
    <div class="relative">
        <button
            class="status-button"
            type="button"
            @click="toggleListVisibility"
            :style="{
            borderColor: currentStatus.color,
            backgroundColor: isVisible ? currentStatus.color : 'transparent',
            color: isVisible ? buttonTextColor : 'black'
        }"
        >
            {{ currentStatus.status_name }}
        </button>
        <ul
            class="absolute bg-white rounded-lg drop-shadow-xl overflow-hidden w-max z-50"
            :id="`status-list-${ entity_id }`"
            v-if="isVisible"
            v-click-outside
        >
            <li
                v-for="(statusItem, index) in statuses"
                class="status"
                :class="statusItem.status_id === currentStatus.status_id ? 'active-status' : '' "
                draggable="true"
                @click="statusSelected(entity_id, statusItem.status_id, is_project)"
                @dragstart="startDrag($event, index)"
                @drop="onDrop($event, index)"
                @dragenter.prevent
                @dragover.prevent
            >
                <div
                    class="rounded-full w-3 h-3 inline-block mr-2"
                    :style="{ backgroundColor: statusItem.color }"
                >
                </div>
                {{ statusItem.status_name }}
            </li>
        </ul>
    </div>
</template>

<style>
.status-button {
    @apply rounded-md border px-2 transition relative bottom-0
}

.status {
    @apply p-4 px-6 hover:bg-[#F7F9FD]
}

.status.active-status {
    box-shadow: 4px 0 0 #0085E0 inset;
    @apply bg-[#EBF5FA] font-semibold text-[#043159]
}

.active-status > div {
    @apply ring-2 ring-white
}
</style>
