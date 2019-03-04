const initialState = {
    token: "",
    twitterAuthToken: "",
    twitterAuthTokenSecret: "",
    googleToken: "",
    actualPage: 'LOGIN_SERVICES'
}

const defaultReducer = (state = initialState, action) => {
    switch (action.type) {
        case 'SET_USER_TOKEN':
            return Object.assign({}, state, {
                token: action.token})
        case 'SET_PAGE':
            return Object.assign({}, state, {
                actualPage: action.page})
        case 'SET_TWITTER_TOKEN':
            return Object.assign({}, state, {
                twitterAuthToken: action.twitterAuthToken,
                twitterAuthTokenSecret: action.twitterAuthTokenSecret})
        case 'SET_GOOGLE_TOKEN':
            return Object.assign({}, state, {
                googleToken: action.googleToken})
        default:
            return state
    }
}

export default defaultReducer;