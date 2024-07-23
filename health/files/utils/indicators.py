def calculate(weight, height, age, waist):
    height_in_meters = height / 100
    bmi = weight / (height_in_meters * height_in_meters)
    bfm = (1.2 * bmi) + (0.23 * age) - (10.8 * 1) - 5.4
    ideal_weight = 22 * (height_in_meters * height_in_meters)

    return round(bmi, 2), round(bfm, 2), round(ideal_weight, 2), round(waist, 2)