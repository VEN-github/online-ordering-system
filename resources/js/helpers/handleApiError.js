export function handleError(response) {
  if (response && response.data.message) {
    throw new Error(response.data.message)
  }

  throw new Error('Something went wrong. Please try again.')
}
