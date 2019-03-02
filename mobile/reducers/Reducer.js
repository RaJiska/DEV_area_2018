import { combineReducers } from 'redux';

const initialState = {
      isFetching: false,
      user: null
  };

const defaultReducer = (state = initialState, action) => {
    switch (action.type) {
        case 'REQUEST_USER':
            return Object.assign({}, state, {
                isFetching: true})
        case 'RECEIVE_USER':
            return Object.assign({}, state, {
                isFetching: false,
                user: action.payload.json})
        default:
            return state
  }
};

export default combineReducers({
  reducer: defaultReducer,
});