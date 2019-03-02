import { combineReducers } from 'redux'

const initialState = {
    token: "test",
}

const defaultReducer = (state = initialState, action) => {
    switch (action.type) {
        case 'SET_USER_TOKEN':
            return Object.assign({}, state, {
                token: action.token})
        default:
            return state
    }
}

export default defaultReducer;