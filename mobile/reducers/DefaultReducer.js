const initialState = {
    token: "",
    twitterAuthToken: "",
    twitterAuthTokenSecret: ""
}

const defaultReducer = (state = initialState, action) => {
    switch (action.type) {
        case 'SET_USER_TOKEN':
            return Object.assign({}, state, {
                token: action.token})
        case 'SET_TWITTER_TOKEN':
            return Object.assign({}, state, {
                twitterAuthToken: action.authToken,
                twitterAuthTokenSecret: action.authTokenSecret})
        default:
            return state
    }
}

export default defaultReducer;