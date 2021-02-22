import React from 'react';
import {HomePage} from "./pages/HomePage";
import {FavPage} from "./pages/Fav";
import 'react-native-gesture-handler';
import {NavigationContainer} from "@react-navigation/native";
import {createStackNavigator} from "@react-navigation/stack";
import {StyleSheet} from "react-native";

const Stack = createStackNavigator();

const App = () => {

    return (
        <NavigationContainer>
            <Stack.Navigator
                screenOptions={{
                    headerShown: true
                }}
            >
                <Stack.Screen
                    options={{headerShown: false}}
                    component={HomePage}
                    name={"Home"}
                />
                <Stack.Screen
                    options={{headerShown: false}}
                    component={FavPage}
                    name={"Fav"}
                />
            </Stack.Navigator>
        </NavigationContainer>
    );
}

export default App;


