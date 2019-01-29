function fetchUser() {
    return dispatch => {
      dispatch()
      return fetch(`https://randomuser.me/api/`)
        .then(response => response.json())
        .then(json => dispatch(receiveUserDetails(json)))
    }
}

function requestUserDetails() {
    return {
        type: 'REQUEST_USER_DETAILS'
    }
}

function receiveUserDetails() {
    return {
        type: 'RECEIVE_USER_DETAILS'
    }
}