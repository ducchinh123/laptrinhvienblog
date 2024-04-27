import instance from './axios'
const uploadApi = {
  image: async (file) => {
    const formData = new FormData()
    formData.append('file', file)
    return await instance.post('http://127.0.0.1:8000/api/upload-image', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  }
}

export default uploadApi
