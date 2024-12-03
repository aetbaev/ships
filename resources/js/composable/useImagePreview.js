export function useImagePreview() {
    const compressImage = async (file, maxWidth, maxHeight, quality) => {
        return new Promise((resolve, reject) => {
            const img = new Image()
            img.onload = () => {
                const canvas = document.createElement('canvas')
                const ctx = canvas.getContext('2d')

                let width = img.width
                let height = img.height
                if (width > maxWidth) {
                    height *= maxWidth / width
                    width = maxWidth
                }
                if (height > maxHeight) {
                    width *= maxHeight / height
                    height = maxHeight
                }
                canvas.width = width
                canvas.height = height

                ctx.drawImage(img, 0, 0, width, height)

                const dataURL = canvas.toDataURL('image/jpeg', quality)

                resolve(dataURL)
            }
            img.src = file
        })
    }

    return {
        compressImage,
    }
}
