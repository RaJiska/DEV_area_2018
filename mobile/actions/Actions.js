export function setUser(token) {
    return {
        type: 'SET_USER_TOKEN', token
    }
}

export function twitterSignIn(authToken, authTokenSecret) {
    return {
        type: 'SET_TWITTER_TOKEN', authToken, authTokenSecret
    }
}