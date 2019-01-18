// configureStore.js

import { createStore, applyMiddleware } from 'redux';
import defaultReducer from './reducers/Reducer';
import thunk from 'redux-thunk';

export default function configureStore() {
  let store = createStore(defaultReducer, applyMiddleware(thunk))
  return store
}