import React from "react";
import {View, StyleSheet, Text} from "react-native";
import BackIcon from "../components/BackIcon";
import FavCard from "../components/FavCard";
import Carousel from 'react-native-snap-carousel';
import {getData, TeachrType} from "../utils/utils";


export function FavPage({navigation}) {
    const teachrs = getData();

    return (
        <View>
            <View style={styles.headerStyle}>
                <View style={styles.backIconContainerStyle}>
                    <BackIcon
                        onPress={() => navigation.goBack()}
                        style={styles.backIconStyle}
                    />
                </View>
                <View>
                    <Text style={styles.titleStyle}>
                        Teach'rs favoris
                    </Text>
                </View>
            </View>
            <View style={styles.bodyStyle}>
                    <Carousel
                        contentContainerCustomStyle={{
                            paddingLeft: 20
                        }}
                        data={teachrs}
                        renderItem={({item, index}: { index: number, item: TeachrType }) =>
                            <FavCard {...item} index={index}/>
                        }
                        sliderWidth={350}
                        itemWidth={250}
                    />
            </View>
        </View>
    )
}

const styles = StyleSheet.create({
    bodyStyle: {
        marginTop: 20,
        height: 400,
        // paddingHorizontal: 20
    },
    headerStyle: {
        backgroundColor: 'dodgerblue',
        height: 180,
        padding: 10
    },

    titleStyle: {
        fontSize: 25,
        marginLeft: 10,
        fontFamily: "Roboto",
        color: "#fff"
    },

    backIconStyle: {
        width: 38,
        height: 38,
    },

    backIconContainerStyle: {
        marginTop: 40,
        marginBottom: 10,
        padding: 0,
        width: "100%",
        height: 50,
        display: "flex",
        alignContent: "flex-start",
        alignItems: "flex-start"
    }
})