import {ref} from "vue"

export function useFileUploader() {
    const progress = ref(0)
    const isLoading = ref(false)
    const error = ref()
    const result = ref()

    const uploadFile = async (url, file) => {
        isLoading.value = true
        progress.value = 0
        error.value = null

        const formData = new FormData()
        formData.append('file', file)

        await axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            onUploadProgress: (event) => {
                if (event.lengthComputable) {
                    progress.value = Math.round((event.loaded / event.total) * 100)
                }
            },
        }).then(({data}) => {
            result.value = data
        }).catch(e => {
            error.value = e?.response?.data?.message || e.message
        }).finally(() => isLoading.value = false)

        return result.value
    }

    return {
        progress,
        isLoading,
        error,
        uploadFile,
    }
}
