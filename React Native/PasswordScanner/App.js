import React from 'react';
import { StyleSheet, Text, View ,TouchableOpacity,Platform, } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';

import HomeScreen from './components/HomeScreen';
import Small from './components/Small';
import Medium from './components/Medium';
import Large from './components/Large';
import FullScreen from './components/FullScreen';


const Stack = createStackNavigator();

function NavStack() {
  return (
     <Stack.Navigator
     initialRouteName="HomeScreen"
        screenOptions={{
          headerTitleAlign: 'center',
          headerStyle: {
            backgroundColor: '#50c878',
          },
          headerTintColor: '#fff',
          headerTitleStyle :{
            fontWeight: 'bold',
          },
        }}
      >
      <Stack.Screen 
        name="HomeScreen" 
        component={HomeScreen} 
        options={{ title: 'HomeScreen' }}
      />
      <Stack.Screen 
        name="Small" 
        component={Small} 
        options={{ title: 'Small' }}
      />
       <Stack.Screen 
        name="Medium" 
        component={Medium} 
        options={{ title: 'Medium' }}
      />
       <Stack.Screen 
        name="Large" 
        component={Large} 
        options={{ title: 'Large' }}
      />
       <Stack.Screen 
        name="FullScreen" 
        component={FullScreen} 
        options={{ title: 'FullScreen' }}
      />
    </Stack.Navigator>
  );
}

export default function App() {
  return (
    <NavigationContainer>
      <NavStack />
    </NavigationContainer>
  );
}

console.disableYellowBox = true;