import { defineStore } from 'pinia'

export const useTaskStatusesStore = defineStore('taskStatusesStore', {
    state: () => {
        return {
            statuses: null
        }
    },
    actions: {
        async initialize() {
            if (this.statuses) {
                return
            }

            this.statuses = await fetch('http://localhost:8000/api/task/statuses')
                .then(res => res.json())
                .then(res => res.data)
                .catch(err => console.error('Error fetching data from BE', err))
        },
        swap(index1, index2) {
            const temp = this.statuses[index1]
            this.statuses[index1] = this.statuses[index2]
            this.statuses[index2] = temp
        }
    }
})
