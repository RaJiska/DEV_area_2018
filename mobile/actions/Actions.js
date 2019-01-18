<<<<<<< dev
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
=======
// Action file define functions that are called by components to modify store variables

export const fetchUser = () => {
    return dispatch => {
        dispatch(requestUser());
        fetch('https://jsonplaceholder.typicode.com/todos/1')
        .then(response => response.json())
        .then(json => dispatch(receiveUser(json)))
        .catch(error => console.log("Fetch error: " + error))
    }
};

export const requestUser = () => {
    return {
        type: 'REQUEST_USER'
    }
}

export const receiveUser = (json) => {
    return {
        type: 'RECEIVE_USER',
        payload: {
            json: json
        }
    }
};
>>>>>>> feat(redux): add basic redux architecture"
