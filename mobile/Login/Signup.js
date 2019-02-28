import React, { Component } from 'react';
import { View, Text, TextInput, TouchableOpacity,StyleSheet ,StatusBar, onButtonPress, Button} from 'react-native';

class SignUp extends Component {
    render() {
	return (
		<View style={styles.signupView}>
			<Text style={styles.signup}>Dont have an account?</Text>
			<Text style={styles.register}>Register</Text> 
		</View>
	);
    }
}

const styles = StyleSheet.create({
	signup:{
		paddingVertical: 15,
		color: '#707070',
	},
	signupView:{
		alignItems: 'center',
	},
    register:{
		color: 'rgba(37, 241, 227, 0.77)',
    },
});

export default SignUp;