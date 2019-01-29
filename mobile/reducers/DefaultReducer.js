import { combineReducers } from 'redux'

const initialState = {
    isFetching: false,
    firstName: null,
    lastName: null
}

const defaultReducer = (state = initialState, action) => {
    switch (action.type) {
        case 'REQUEST_USER_DETAILS':
            return;
        case 'RECEIVE USER_DETAILS':
            return;
        default:
            return state
    }
}

export default combineReducers({
    reducer: defaultReducer,
})