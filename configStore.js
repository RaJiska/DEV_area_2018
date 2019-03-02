import { createStore, applyMiddleware } from 'redux'
import defaultReducer from './reducers/DefaultReducer'
import thunk from 'redux-thunk'

export default function configStore() {
    let store = createStore(defaultReducer, applyMiddleware(thunk))
    return store
}