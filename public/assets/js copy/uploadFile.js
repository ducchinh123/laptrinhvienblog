import uploadApi from './callApiUploadImage.js'
export default function uploadImage(file) {
  return {
    upload: () => {
      return new Promise(async (resolve, reject) => {
        file.file.then(async (file) => {
          try {
            if (!file) return '';

            // Call API upload image to server

            const response = await uploadApi.image(file)

            if (response) {
              const urlImage = `http://127.0.0.1:8000${response?.data.url}`
              // result

              resolve({ default: urlImage })
            }
          } catch (error) {
            reject(console.log(error))
          }
        })
      })
    }
  }
}
