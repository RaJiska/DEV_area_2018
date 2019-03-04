export function setUser(token) {
    return {
        type: 'SET_USER_TOKEN', token
    }
}

export function setPage(page) {
    return {
        type: 'SET_PAGE', page
    }
}

export function twitterSignIn(twitterAuthToken, twitterAuthTokenSecret) {
    return {
        type: 'SET_TWITTER_TOKEN', twitterAuthToken, twitterAuthTokenSecret
    }
}

export function googleSignIn(googleToken) {
    return {
        type: 'SET_GOOGLE_TOKEN', googleToken
    }
}